<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request; //vender\laravel\framework\src\Illuminate
use App\Http\Controllers\Controller;
//以下を記載することでNews Modelが扱えるようになる
use App\News;
use App\History;
use carbon\Carbon;
use Storage;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view('admin.news.create'); //Route::get('news/create'
    }

    public function create(Request $request) //Route::post('news/create'
    {
        //メソッドの中でクラスに定義された変数を使用したいときにこの$thisを使用します．
        //$thisが参照できるのは、変数以外にもメソッドも含みます。
        $this->validate($request, News::$rules); //use App\News;のNewsクラスの変数$rules

        $news = new News;
        /*
        アロー演算子「->」はインスタンスのプロパティやメソッドにアクセスする時に用いられる演算子です．
        (https://tomo-lifeblog.com/what-arrow-scope-php)
        なお，$requestはRequestのインスタンスである．
        */
        $form = $request->all(); //$request->all();はformで入力された値を取得することができます．
<<<<<<< HEAD
        
=======

>>>>>>> f44c57b42a2ab1a40ffd0a86981fbd0f5a009167
        /*
        $formには，
        ["title" => "タイトルの内容"
        "body" => "本文の内容"
        "_token" => "MRwPPawSebvocRdrOoLUrGo8ID6lTDRwfweenj3K"
        "image" => UploadedFile]
        というデータが入っています。そこで不要な「_token」と「image」を削除します．
        そのメソッドがunsetというメソッドです．
        */

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if(isset($form['image'])){
            //$path = $request->file('image')->store('public/image'); //create.blade.phpの<input type="file" class="form-control-file" name="image"> & storeはパスを指定するメソッド．
            //$news->image_path = basename($path); //basenameは，ファイル名のみを取り出す
<<<<<<< HEAD
            
=======

>>>>>>> f44c57b42a2ab1a40ffd0a86981fbd0f5a009167
            /*
            スコープ定義演算子「::」は，クラスのプロパティとメソッドにアクセスする時に使います。
            (https://tomo-lifeblog.com/what-arrow-scope-php)
            */

            /*
<<<<<<< HEAD
            (1)$news->image_pathは$news['image_path']と記載してもよい．
            (2)$newsはimage_pathを持っておらず，以下の「$news->image_path = ～;」で設定している．
            */
            
=======
            (1)$news->image_pathは$news['image_path']と記載してもよい
            (2)$newsはimage_pathを持っておらず，以下の「$news->image_path = ～;」で設定している．
            */

>>>>>>> f44c57b42a2ab1a40ffd0a86981fbd0f5a009167
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            $news->image_path = Storage::disk('s3')->url($path);
        } else {
            $news->image_path = null;
        }

        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        //フォームから送信されてきたimageを削除する
        unset($form['image']);
<<<<<<< HEAD
        
        
=======

>>>>>>> f44c57b42a2ab1a40ffd0a86981fbd0f5a009167
        //データベースに保存する
        $news->fill($form); //Newsテーブル($news = new News;)に$formを挿入する
        $news->save();

        return redirect('admin/news');
    }


    public function index(Request $request) //Route::get('news'
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {

        /*
        (1)
            $cond_title = $request->cond_title;の「$request->cond_title」は，
            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">の
            name="cond_title"と対応している．
        (2)
            このcond_titleはいったいどこから現れたのでしょうか？
            それは、最後のreturn view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);が
            Requestにcond_titleを送っているのです。
            最初に開いた段階では、cond_titleは存在しないのです。
        (3)
            $posts = News::where('title', $cond_title)->get();でwhereメソッドを使うと、
            newsテーブルの中のtitleカラムで
            $cond_title（ユーザーが入力した文字）に一致するレコードを
            すべて取得することができます。
        */

        $posts = News::where('title', $cond_title)->get();
        } else {
        // それ以外はすべてのニュースを取得する
        $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request) //Route::get('news/edit'
    {

          //News Modelから該当するデータを取得する
          $news = News::find($request->id);
          if(empty($news)){
              abort(404);
          }
          return view('admin.news.edit', ['news_form' => $news]);
    }

    public function update(Request $request) //Route::post('news/edit'
    {
            //Validationをかける
            $this->validate($request, News::$rules);
            //News Modelから該当するデータを取得する
            $news = News::find($request->id);
            //送信されてきたフォームデータを格納する
            $news_form = $request->all();
            if ($request->remove == 'true') {
<<<<<<< HEAD
              ////$news_form['image_path']は$news->image_pathと記載してもよい．
=======
              //$news_form['image_path']は$news->image_pathと記載してもよい．
>>>>>>> f44c57b42a2ab1a40ffd0a86981fbd0f5a009167
              $news_form['image_path'] = null;
            } elseif ($request->file('image')) {
              $path = Storage::disk('s3')->putFile('/',$news_form['image'],'public');
              $news['image_path'] = Storage::disk('s3')->url($path);
            } else {
              $news_form['image_path'] = $news->image_path;
            }

            unset($news_form['_token']);
            unset($news_form['image']);
            unset($news_form['remove']);

            //該当するデータを上書きして保存する
            $news->fill($news_form)->save();
            /*
            $news->fill($news_form)->save();
            は、
            $news->fill($news_form);
            $news->save();
            を短縮して書いたものになります。
            */

            $history = new History;
            $history->news_id = $news->id;
            $history->edited_at = Carbon::now();
            $history->save();

            return redirect('admin/news/');
    }

    public function delete(Request $request)
    {
        //該当するNews Modelを取得
        $news = News::find($request->id);

        //削除する
        $news->delete();
        return redirect('admin/news/');

        /*
        削除機能は画面を持たず、id で指定されたModelをすぐに削除します。
        Controllerの最後で一覧画面にリダイレクトしているため、削除機能は画面を持っていません。
        そのため、Viewテンプレートは不要です。
        */
    }

}
?>
