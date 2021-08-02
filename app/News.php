<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//バリデーションを定義する
class News extends Model
{
    //idはcreate(), update(), fill()不可
    protected $guarded = array('id');
    
    //$rulesは〇〇Controller.phpでvalidationを行う
    public static $rules =array(
        'title' => 'required',
        'body' => 'required',
    );
    
    //News Modelに関連付けを行う(News ModelがHistory Modelを参照する)
    public function histories(){
        return $this->hasMany('App\History')->latest()->limit(5);
    }
}
