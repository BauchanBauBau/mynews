<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    public function index(Request $request){
        
        $profile_title = $request->profile_title;
        if ($profile_title != '') {
            
        /*
        (1)
            このprofile_titleはいったいどこから現れたのでしょうか？
            それは、最後のreturn view('profile.index', ['profils' => $profils, 'profile_title' => $profile_title]);が
            Requestにprofile_titleを送っているのです。
            最初に開いた段階では、profile_titleは存在しないのです。
        (2)
            $profils = Profile::where('title', $profile_title)->get();でwhereメソッドを使うと、
            newsテーブルの中のtitleカラムで
            $profile_title（ユーザーが入力した文字）に一致するレコードを
            すべて取得することができます。
        */
          
        $profiles = Profile::where('name', $profile_title)->get();
        } else {
        $profiles = Profile::all();
        }
        
        return view('admin.profile.index', ['profiles' => $profiles, 'profile_title' => $profile_title]);
    }

}
?>
