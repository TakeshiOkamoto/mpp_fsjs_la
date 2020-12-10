<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// 追加分
use App\FsjsCapital;
use App\FsjsJournal;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // 数字チェック
    public static function isNumeric($str){
        if (preg_match("/\A[0-9]+\z/",$str)){
            if($str <= 2147483647)
               return TRUE;
            else
               return FALSE;         
        }else{
           return FALSE;
        }
    } 
       
    // 全角 => 半角変換 + trim
    public static function trim($str){
        if (isset($str)){
            // a 全角英数字を半角へ
            // s 全角スペースを半角へ
            return trim(mb_convert_kana($str, 'as'));
        }else{
            return "";
        }
    }        
    
    // 対象科目の合計金額を取得する
    public static function getAccountTotal($yyyy, $obj, $target_id){
        
        $capital = FsjsCapital::where('yyyy', $yyyy)->get();
        if(count($capital) === 0){
            return 0;
        }
        
        // 借方
        $debit = FsjsJournal::where('yyyy', $yyyy)->where('debit_account_id', $target_id)
                  ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
        // 貸方
        $credit = FsjsJournal::where('yyyy', $yyyy)->where('credit_account_id', $target_id)
                  ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
        
        if($obj == "m4"){
            // 未払金
            $total = $capital[0]->$obj + $credit[0]->money - $debit[0]->money;
        }else{  
            // 現金、その他の預金、前払金
            $total = $capital[0]->$obj + $debit[0]->money - $credit[0]->money;
        }
        
        return $total;   
    }
}
