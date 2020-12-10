<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加分
use App\FsjsAccount;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{    
    // 種類コードから種類名を取得する
    public function getTypeName($val)
    {
        if($val == "1"){
            return "借方";  
        }else if($val == "2"){
            return "貸方";  
        }
        return "借方 + 貸方";  
    }
    
    public function index(Request $request)
    {
        $items = FsjsAccount::whereRaw('1=1');
        $name = Controller::trim($request->name);
           
        if ($name != ""){
            $arr = explode(' ', $name);
            for ($i=0; $i<count($arr); $i++){
                $keyword = str_replace('%', '\%', $arr[$i]);            
                $items = $items->where('name', 'like', "%$keyword%");
            }
        }
        $items = $items->orderBy('sort_list','ASC')->paginate(25); 
        
        foreach ($items as $item){
            $item->types = $this->getTypeName($item->types);
            $item->expense_flg = $item->expense_flg == 1 ? "true" : "false";
        }
        
        return view('accounts.index', ['items' => $items, 'name'=> $name]);
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        // パラメータ
        $param = [
            'name'          => Controller::trim($request->name),  
            'types'         => $request->types,  
            'expense_flg'   => isset($request->expense_flg)? "1" : "0",
            'sort_list'     => $request->sort_list,  
            'sort_expense'  => $request->sort_expense,      
        ];
        $request->merge($param); 
        
        // バリデーション               
        $request->validate(FsjsAccount::Rules());   
               
        // トランザクション
        DB::transaction(function () use ($param) {
            $account = new FsjsAccount;
            $account->fill($param)->save();
        });

        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '登録しました。'); 
        
        return redirect(url('accounts'));
    }

    public function show($id)
    {
        $item = FsjsAccount::where('id', $id)->get();
        if(count($item) === 1){
            $item[0]->types = $this->getTypeName($item[0]->types);
            $item[0]->expense_flg = $item[0]->expense_flg == 1 ? "true" : "false";
            return view('accounts.show', ['item' => $item[0]]);
        }else{
           return redirect(url('/'));
        }
    }

    public function edit($id)
    {
        $item = FsjsAccount::where('id', $id)->get();
        if(count($item) === 1){
           return view('accounts.edit', ['item' => $item[0]]);
        }else{
           return redirect(url('/'));
        }
    }

    public function update(Request $request, $id)
    {
        // パラメータ
        $param = [
            'name'          => Controller::trim($request->name),  
            'types'         => $request->types,  
            'expense_flg'   => isset($request->expense_flg)? "1" : "0",
            'sort_list'     => $request->sort_list,  
            'sort_expense'  => $request->sort_expense,   
        ];
        $request->merge($param); 
        
        // 自分自身のnameのユニークを確認しない
        $rules = FsjsAccount::Rules();
        $rules['name'] = 'required|max:20|unique:fsjs_accounts,name,' . $id . ',id';   

        // バリデーション     
        $request->validate($rules);  
         
        // トランザクション      
        DB::transaction(function () use ($param, $id) {
            FsjsAccount::where('id', $id)->update($param);
        });
        
        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '更新しました。');
        
        return redirect(url('accounts'));
    }

    public function destroy($id)
    {
        // トランザクション
        DB::transaction(function () use ($id) {
            FsjsAccount::where('id', $id)->delete();
        });
        
        // フラッシュ
        session()->flash('flash_flg', 0);
        session()->flash('flash_msg', '削除しました。');
    }
}
