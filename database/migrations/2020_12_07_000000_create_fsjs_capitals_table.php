<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsjsCapitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // 元入金テーブル
        // ※1/1(期首)の元入金。最低限必要な項目のみ
        Schema::create('fsjs_capitals', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // 西暦(年)
            $table->integer('yyyy')->unique();
            // 現金
            $table->integer('m1');
            // その他の預金
            $table->integer('m2');
            // 前払金
            $table->integer('m3');
            // 未払金
            $table->integer('m4');                                    
            
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
        Schema::dropIfExists('fsjs_capitals');
    }
}
