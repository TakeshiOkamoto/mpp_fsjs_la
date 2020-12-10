<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsjsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // 勘定科目マスタ 
        Schema::create('fsjs_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // 名前
            $table->string('name')->unique();
            // 種類(1:借方 2:貸方 3:両方)
            $table->integer('types')->index();
            // 経費フラグ(true:経費 false:経費以外)
            $table->boolean('expense_flg')->index();
            // 表示順序(リスト用)
            $table->integer('sort_list');
            // 表示順序(経費用) ※損益計算書で使用する経費以外は-1
            $table->integer('sort_expense');
            
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
        Schema::dropIfExists('fsjs_accounts');
    }
}
