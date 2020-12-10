<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加分
use App\FsjsCapital;
use Illuminate\Support\Facades\DB;

class CapitalsController extends Controller
{    
    
    public function index(Request $request)
    {
        $items = FsjsCapital::orderBy('yyyy','DESC')->paginate(25);         
        return view('capitals.index', ['items' => $items]);
    }

    public function create()
    {
        return view('capitals.create');
    }

    public function store(Request $request)
    {
        // パラメータ
        $param = [
            'yyyy'  => $request->yyyy,
            'm1'    => $request->m1,  
            'm2'    => $request->m2,  
            'm3'    => $request->m3,  
            'm4'    => $request->m4,  
        ];
        $request->merge($param); 
        
        // バリデーション               
        $request->validate(FsjsCapital::Rules());   
               
        // トランザクション
        DB::transaction(function () use ($param) {
            $capital = new FsjsCapital;
            $capital->fill($param)->save();
        });

        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '登録しました。'); 
        
        return redirect(url('capitals'));
    }

    public function show($id)
    {
       return redirect(url('capitals'));
    }
    
    public function edit($id)
    {
        $item = FsjsCapital::where('id', $id)->get();
        if(count($item) === 1){
           return view('capitals.edit', ['item' => $item[0]]);
        }else{
           return redirect(url('/'));
        }
    }

    public function update(Request $request, $id)
    {
        // パラメータ      
        $param = [
            'yyyy'  => $request->yyyy,
            'm1'    => $request->m1,  
            'm2'    => $request->m2,  
            'm3'    => $request->m3,  
            'm4'    => $request->m4,  
        ];
        $request->merge($param); 
        
        // 自分自身のyyyyのユニークを確認しない
        $rules = FsjsCapital::Rules();
        $rules['yyyy'] = 'required|integer|min:1989|max:2099|unique:fsjs_capitals,yyyy,' . $id . ',id';   

        // バリデーション     
        $request->validate($rules);  
         
        // トランザクション      
        DB::transaction(function () use ($param, $id) {
            FsjsCapital::where('id', $id)->update($param);
        });
        
        // フラッシュ
        session()->flash('flash_flg', 1);
        session()->flash('flash_msg', '更新しました。');
        
        return redirect(url('capitals'));
    }

    public function destroy($id)
    {
        // トランザクション
        DB::transaction(function () use ($id) {
            FsjsCapital::where('id', $id)->delete();
            
            // --------------------------------------------------
            // 必要であれば、該当年度の仕訳帳も削除して下さい。
            // --------------------------------------------------
        });
        
        // フラッシュ
        session()->flash('flash_flg', 0);
        session()->flash('flash_msg', '削除しました。');
    }
}
