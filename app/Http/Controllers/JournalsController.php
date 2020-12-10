<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加分
use App\FsjsAccount;
use App\FsjsCapital;
use App\FsjsJournal;
use Illuminate\Support\Facades\DB;

class JournalsController extends Controller
{   

//----------------------------------------------------------
// メンバ
//----------------------------------------------------------
  
    private $debit_list;   // 借方リスト
    private $credit_list;  // 貸方リスト
     
//----------------------------------------------------------
// メソッド
//----------------------------------------------------------
     
    // 借方のリストを取得する 
    public function getDebitList($keihi = false)
    {
        $debits = FsjsAccount::where('types', '<>', '2')
                    ->orderBy('sort_list', 'ASC' )
                    ->select('id', 'name', 'expense_flg')
                    ->get();
                    
        foreach ($debits as $debit){
            if($debit->expense_flg == 1 && $keihi){
                $debit->name = '[経費]' . $debit->name;
            }
        }

        return $debits;
    }
    
    // 貸方のリストを取得する 
    public function getCreditList()
    {
        $credits = FsjsAccount::where('types', '<>', '1')
                    ->orderBy('sort_list', 'ASC' )
                    ->select('id', 'name')
                    ->get();
        
        return $credits;
    }  
    
    // 借方/貸方の名前を設定する
    public function setAccountName($item){
      
        // 借方
        $item->debit = "不明";
        foreach ($this->debit_list as $debit){
            if ($debit->id == $item->debit_account_id){
                $item->debit = $debit->name;
                break;
            }
        }  
        
        // 貸方
        $item->credit = "不明";
        foreach ($this->credit_list as $credit){
            if ($credit->id == $item->credit_account_id){
                $item->credit = $credit->name;
                break;
            }
        }  
    }      
    
//----------------------------------------------------------
// バリデーション
//----------------------------------------------------------
    
    // 対象科目の合計金額を取得する
    public function getTargetTotal($v, $obj, $target_id, $edit_id)
    {
        if (!($v['credit_account_id'] == $target_id ||  $v['debit_account_id'] == $target_id)){
            return 0;
        }
        
        // 元入金テーブル
        $capital = FsjsCapital::where('yyyy', $v['yyyy'])->get();
        
        // 編集
        if($edit_id != ""){
            // 借方
            $debit  = FsjsJournal::where('yyyy', $v['yyyy'])
                       ->where('debit_account_id', $target_id)
                       ->where('id', '<>', $edit_id)
                       ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
                       
            // 貸方
            $credit = FsjsJournal::where('yyyy', $v['yyyy'])
                       ->where('credit_account_id', $target_id)
                       ->where('id', '<>', $edit_id)
                       ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
        // 新規
        }else{
            // 借方
            $debit  = FsjsJournal::where('yyyy', $v['yyyy'])
                       ->where('debit_account_id', $target_id)
                       ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
                       
            // 貸方
            $credit = FsjsJournal::where('yyyy', $v['yyyy'])
                       ->where('credit_account_id', $target_id)
                       ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();                                              
        }
        
        // 未払金
        if ($target_id == 5){
            // 借方
            if ($v['debit_account_id'] == $target_id){      
              $total = ($debit[0]->money + $v['money']) - ($capital[0]->$obj + $credit[0]->money); 
            // 貸方  
            }else{
              $total = ($debit[0]->money) - ($capital[0]->$obj + $credit[0]->money + $v['money']); 
            }    
            
        // 現金、その他の預金、前払金       
        }else{
            // 借方
            if ($v['debit_account_id'] == $target_id){      
              $total = ($capital[0]->$obj + $debit[0]->money + $v['money']) - $credit[0]->money;
            // 貸方  
            }else{
              $total = ($capital[0]->$obj + $debit[0]->money) - $credit[0]->money - $v['money'];
            }                
        }
        
        return  $total;
    }
    
    // 現金、その他の預金、前払金、未払金の整合性チェック
    public function money_check($v, $id)
    {
         // 仕訳帳は1/1から順番に記帳しないと矛盾が生じてエラーが多発しやすいです。
         // エラーチェックを解除したい場合は次のコードを有効にして下さい。
         // return NULL;
          
         // 現金 
         $total = $this->getTargetTotal($v, "m1", 3, $id);
         if($total < 0){
             return redirect()->back()
                      ->withErrors(['money' => "現金の合計が" .  number_format($total) . "円になります。この仕訳の前に「借方」に現金を追加して下さい。 例)借方(現金) 貸方(事業主借)"])
                      ->withInput();
         }
         
         // その他の預金
         $total = $this->getTargetTotal($v, "m2", 4, $id);
         if($total < 0){
             return redirect()->back()
                      ->withErrors(['money' => "その他の預金の合計が" .  number_format($total) . "円になります。※他の仕訳の「その他の預金」を確認して下さい。"])
                      ->withInput();
         }
                  
         // 前払金
         $total = $this->getTargetTotal($v, "m3", 13, $id);
         if($total < 0){
             return redirect()->back()
                      ->withErrors(['money' => "前払金の合計が" .  number_format($total) . "円になります。※他の仕訳の「前払金」を確認して下さい。"])
                      ->withInput();
         }
         
         // 未払金
         $total = $this->getTargetTotal($v, "m4", 5, $id);
         if($total > 0){
             return redirect()->back()
                      ->withErrors(['money' => "このままだと未払金を支払い過ぎます。(" .  number_format($total) . "円多い) ※他の仕訳の「未払金」を確認して下さい。"])
                      ->withInput();
         }
                  
        return NULL;
    } 
       
//----------------------------------------------------------
// ルーティング
//----------------------------------------------------------
    
    public function index(Request $request)
    {
        // 元入金
        $capital = FsjsCapital::where('yyyy', $request->yyyy)->get();
        if(count($capital) === 0){
            return redirect(url('/'));
        }
        
        // 仕訳
        $items = FsjsJournal::where('yyyy', $request->yyyy)
                   ->orderBy('mm','DESC')
                   ->orderBy('dd','DESC')
                   ->orderBy('summary','ASC')
                   ->orderBy('debit_account_id','ASC')
                   ->paginate(50);         
        
        // 借方/貸方の名前を設定
        $this->debit_list  = $this->getDebitList(false);   // 借方リスト 
        $this->credit_list = $this->getCreditList();       // 貸方リスト 
        foreach ($items as $item){
            $this->setAccountName($item);
        }
                    
        // 現金
        $money            = Controller::getAccountTotal($request->yyyy, "m1", 3);
        // その他の預金
        $deposit          = Controller::getAccountTotal($request->yyyy, "m2", 4);
        // 前払金
        $advance_payment  = Controller::getAccountTotal($request->yyyy, "m3", 13);
        // 未払金
        $accounts_payable = Controller::getAccountTotal($request->yyyy, "m4", 5);
        // 売上        
        $sales = FsjsJournal::where('yyyy', $request->yyyy)->where('credit_account_id', 12)
                  ->select(DB::Raw("IFNULL(SUM(money),0) AS money"))->get();
        $sales= $sales[0]->money;
                                      
        return view('journals.index', [
                                       'items'    => $items,
                                       'capital'  => $capital[0],
                                       'yyyy'     => $request->yyyy,
                                       'money'    => $money,
                                       'deposit'  => $deposit,
                                       'advance_payment'  => $advance_payment,
                                       'accounts_payable' => $accounts_payable,
                                       'sales'            => $sales,
                                       ]);
    }

    public function create(Request $request)
    {        
        return view('journals.create',[
                                       'yyyy' => $request->yyyy,
                                       'debit_list'  => $this->getDebitList(true),  // 借方リスト
                                       'credit_list' => $this->getCreditList(),     // 貸方リスト
                                      ]);
    }

    public function store(Request $request)
    {      
        // 存在しない会計年度はスルーする
        $capital = FsjsCapital::where('yyyy', $request->yyyy)->get();
        if(count($capital) === 0){
            return redirect(url('/'));
        }
      
        // パラメータ
        $param = [
            'yyyy'  => $request->yyyy,
            'mm'    => $request->mm,  
            'dd'    => $request->dd,  
            'debit_account_id'   => $request->debit_account_id,  
            'credit_account_id'  => $request->credit_account_id,  
            'money'    => $request->money,  
            'summary'  => Controller::trim($request->summary),  
        ];
        $request->merge($param); 
        
        // 通常のバリデーション ※戻り値は検証後の各値の配列
        $validatedData = $request->validate(FsjsJournal::Rules());
     
        // 独自のバリデーション(現金、その他の預金、前払金、未払金の整合性)
        $result = $this->money_check($validatedData, "");
        if(isset($result)){
            return $result;
        }
        
        // トランザクション
        DB::transaction(function () use ($param) {
            $journal = new FsjsJournal;
            $journal->fill($param)->save();
        });

        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '登録しました。'); 
        
        return redirect(url('journals?yyyy=' . $request->yyyy));
    }

    public function show($id)
    {
        $item = FsjsJournal::where('id', $id)->get();
        if(count($item) === 1){
          
            // 借方/貸方の名前を設定
            $this->debit_list  = $this->getDebitList(false);   // 借方リスト
            $this->credit_list = $this->getCreditList();       // 貸方リスト
            $this->setAccountName($item[0]);
            
            return view('journals.show', ['item' => $item[0]]);
        }else{
           return redirect(url('/'));
        }
    }
    
    public function edit($id)
    {
        $item = FsjsJournal::where('id', $id)->get();
        if(count($item) === 1){
           return view('journals.edit', [
                                         'item' => $item[0],
                                         'debit_list'  => $this->getDebitList(true),  // 借方リスト
                                         'credit_list' => $this->getCreditList(),     // 貸方リスト
                                        ]);
        }else{
           return redirect(url('/'));
        }
    }

    public function update(Request $request, $id)
    {
        // パラメータ      
        $param = [
            'yyyy'  => $request->yyyy,
            'mm'    => $request->mm,  
            'dd'    => $request->dd,  
            'debit_account_id'   => $request->debit_account_id,  
            'credit_account_id'  => $request->credit_account_id,  
            'money'    => $request->money,  
            'summary'  => Controller::trim($request->summary),  
        ];
        $request->merge($param); 
        
        // 通常のバリデーション ※戻り値は検証後の各値の配列
        $validatedData = $request->validate(FsjsJournal::Rules());
     
        // 独自のバリデーション(現金、その他の預金、前払金、未払金の整合性)
        $result = $this->money_check($validatedData, $id);
        if(isset($result)){
            return $result;
        }

        // トランザクション      
        DB::transaction(function () use ($param, $id) {
            FsjsJournal::where('id', $id)->update($param);
        });
        
        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '更新しました。');
        
        return redirect(url('journals?yyyy=' . $request->yyyy));
    }

    public function destroy($id)
    {
        // トランザクション
        DB::transaction(function () use ($id) {
            FsjsJournal::where('id', $id)->delete();
        });
        
        // フラッシュ
        session()->flash('flash_flg', 0);
        session()->flash('flash_msg', '削除しました。');
    }
}
