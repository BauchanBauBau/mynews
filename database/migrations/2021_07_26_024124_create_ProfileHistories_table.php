<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilehistoriesTable extends Migration
{

    /*
    〇teble名は以下のように「ProfileHistories」であったが・・・
    
    mysql> show tables;
    +------------------+
    | Tables_in_mynews |
    +------------------+
    | ProfileHistories
    
    〇エラー「SQLSTATE[42S02]」で'profile_histories' doesn't existという状態になったため，
    以下のようにtable名を「profile_histories」に変更した．
    
    mysql> rename table ProfileHistories to profile_histories;
    Query OK, 0 rows affected (0.01 sec)
    
    mysql> show tables;
    +-------------------+
    | Tables_in_mynews  |
    +-------------------+
    | (省略)            |
    | profile_histories |
    */

    public function up()
    {
        Schema::create('profile_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('profile_id');
            $table->string('edited_at');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_histories');
    }
}
