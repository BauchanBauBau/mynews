<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {   
        /*
        sortBy(‘xxx’)：xxxで昇順に並べ換える。
        sortByDesc(‘xxx’)：xxxで降順に並べ換える。
        */
        $posts = News::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0){
            $headline = $posts->shift();
        }else{
            $headline = null;
        }
        
        //news/index.blade.phpファイルを渡している
        //またViewテンプレートにheadline, posts, という変数を渡している．
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
