<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //idはcreate(), update(), fill()不可
    protected $guarded = array('id');
    
    //$rulesは〇〇Controller.phpでvalidationを行う
    public static $rules = array(
        'news_id' => 'required',
        'edited_at' => 'required',
    );
}
