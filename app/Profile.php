<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //idはcreate(), update(), fill()不可
    protected $guarded = array('id');
    
    //$rulesは〇〇Controller.phpでvalidationを行う
    public static $rules =array(
    'name' => 'required',
    );
    
    //Profile Modelに関連付けを行う(Profile ModelがProfileHistory Modelを参照する)
    public function ProfileHistories()
    {
        return $this->hasMany('App\ProfileHistory')->latest()->limit(5);
    }
}
