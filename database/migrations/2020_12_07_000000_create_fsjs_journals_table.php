<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsjsJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // 仕訳帳テーブル
        Schema::create('fsjs_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // 年
            $table->integer('yyyy')->index();
            // 月
            $table->integer('mm')->index();
            // 日
            $table->integer('dd')->index();                                    
            // 科目コード(借方)
            $table->integer('debit_account_id');
            // 科目コード(貸方)
            $table->integer('credit_account_id');
            // 金額
            $table->integer('money');
            // 摘要
            $table->string('summary');                                    
            
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
        Schema::dropIfExists('fsjs_journals');
    }
}
