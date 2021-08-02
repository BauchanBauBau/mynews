<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request; //vender\laravel\framework\src\Illuminate
use App\Http\Controllers\Controller;
//以下を記載することでProfile Modelが扱えるようになる
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        
        $this->validate($request, Profile::$rules); //App\Profile;のProfileクラスの変数$rules
        
        $profile = new Profile;
            
        //$request->all();はformで入力された値を取得することができます
        $form = $request->all();
        
        //フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        //データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request)
    {
        //News Modelからデータを取得する
        $profile = Profile::find($request->id);
        if(empty($profile)){
          abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        //Validationをかける
        $this->validate($request, Profile::$rules);
        
        //News Modelから該当するデータを取得する
        $profile = Profile::find($request->id);
    
        $profile_form = $request->all();
        
        unset($profile_form['_token']);
        
        //該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        /*
        $profile->fill($profile_form)->save();
        は、
        $profile->fill($profile_form);
        $profile->save();
        を短縮して書いたものになります。
        */
        
        $history = new ProfileHistory;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        
        return redirect('profile');
    }
    
    public function delete(Request $request)
    {
        //該当するNews Modelを取得
        $profile = Profile::find($request->id);
        
        //削除する
        $profile->delete();
        return redirect('admin/profile/index');
        
        /*
        削除機能は画面を持たず、id で指定されたModelをすぐに削除します。
        Controllerの最後で一覧画面にリダイレクトしているため、削除機能は画面を持っていません。
        そのため、Viewテンプレートは不要です。
        */
    }
    
}
?>