<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加分
use App\FsjsAccount;
use App\FsjsCapital;
use App\FsjsJournal;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{   
    
    public function index(Request $request)
    {
        $capitals = FsjsCapital::orderBy('yyyy', 'DESC')->get();
        
        if(isset($request->yyyy)){
            
            // 数値チェック ※42行目の$request->yyyy用
            if (!Controller::isNumeric($request->yyyy)){
                return redirect(url('/'));  
            }
            // 元入金(期首)
            $report_bs_st = FsjsCapital::where('yyyy', $request->yyyy)->get();
            if(count($report_bs_st) === 0){
                return redirect(url('/'));
            }
                      
            // ----------------------------------
            // 損益計算書
            // ----------------------------------
            
            // 売上
            $report_pl_total = FsjsJournal::where('yyyy', $request->yyyy)
                                 ->where('credit_account_id', 12)
                                 ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get()[0]->money;

            // 経費
            $report_pl_keihi = FsjsAccount::leftJoin('fsjs_journals', 'fsjs_accounts.id', '=', DB::Raw("fsjs_journals.debit_account_id AND fsjs_journals.yyyy=" . $request->yyyy))
                                 ->where('fsjs_accounts.expense_flg', 1)
                                 ->groupBy('fsjs_accounts.name')
                                 ->orderBy('fsjs_accounts.sort_expense', 'ASC')
                                 ->select(DB::Raw("fsjs_accounts.name,IFNULL(SUM(fsjs_journals.money),0) AS money"))
                                 ->get();


            // ----------------------------------
            //  月別売上(収入)金額及び仕入金額
            // ----------------------------------
            $report_month = [];
            for($i=0; $i<12;$i++){
                $report_month[$i] = FsjsJournal::where('yyyy', $request->yyyy)
                                      ->where('mm', ($i +1))
                                      ->where('credit_account_id', 12)
                                      ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get()[0];
            }
            
            // ----------------------------------
            // 貸借対照表
            // ----------------------------------
            
            // 元入金(期首)
            $report_bs_st = $report_bs_st[0];
            
            // 事業主貸(期末)
            $report_bs_debit  = FsjsJournal::where('yyyy', $request->yyyy)
                                 ->where('debit_account_id', 1)
                                 ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get()[0]->money;
            // 事業主借(期末)
            $report_bs_credit = FsjsJournal::where('yyyy', $request->yyyy)
                                 ->where('credit_account_id', 2)
                                 ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get()[0]->money;
           
            // 現金(期末)
            $report_bs_m1 = Controller::getAccountTotal($request->yyyy, "m1", 3);
            // その他の預金(期末)
            $report_bs_m2 = Controller::getAccountTotal($request->yyyy, "m2", 4);
            // 前払金(期末)
            $report_bs_m3 = Controller::getAccountTotal($request->yyyy, "m3", 13);
            // 未払金(期末)
            $report_bs_m4 = Controller::getAccountTotal($request->yyyy, "m4", 5);
            
            return view('index', [
                                  'yyyy'     => $request->yyyy,
                                  'capitals' => $capitals,
                                  'report_pl_total'  => $report_pl_total,
                                  'report_pl_keihi'  => $report_pl_keihi,
                                  'report_month'     => $report_month,
                                  'report_bs_st'     => $report_bs_st,
                                  'report_bs_debit'  => $report_bs_debit,
                                  'report_bs_credit' => $report_bs_credit,
                                  'report_bs_m1'     => $report_bs_m1,
                                  'report_bs_m2'     => $report_bs_m2,
                                  'report_bs_m3'     => $report_bs_m3,
                                  'report_bs_m4'     => $report_bs_m4,
                                ]);
        }else{
            return view('index', [
                                  'yyyy'     => $request->yyyy,
                                  'capitals' => $capitals,
                                 ]);
        } 
    }
}
