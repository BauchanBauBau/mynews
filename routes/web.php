<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    //以下はnews
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create');
    
    Route::get('news', 'Admin\NewsController@index');
    
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    
    Route::get('news/delete', 'Admin\NewsController@delete');
    
    
    //以下はprofile
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    
    Route::get('profile/delete', 'Admin\ProfileController@delete');
    
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

    /*
    (1)
        admin/news/createにアクセスしたときに、GETとPOSTの両方が設定されています。
        GETの場合は add Actionを、POSTの場合は create Action を呼び出すようにしています。
    (2)
        「Route::get('aaa/bbb', 'ccc\dddController@eee')->middleware('auth');」は，
        ログインしていない状態で管理画面にアクセスしようとしたときに、
        ログイン画面にリダイレクトするようにRoutingで設定します。
        routes/web.php のRoutingの設定の最後に 「->middleware(‘auth’)」 と入れることで、
        リダイレクトされるようになります。
    */
    
Route::get('/', 'NewsController@index');

Route::get('profile', 'ProfileController@index');