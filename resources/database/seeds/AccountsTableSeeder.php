<?php

use Illuminate\Database\Seeder;

// 追加分
use App\FsjsAccount;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {   
        // 勘定科目マスタのデータインポート
        DB::transaction(function (){  
        
            // 全削除
            DB::table('fsjs_accounts')->truncate();
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 1,
                'name'         => "事業主貸",
                'types'        => 1,
                'expense_flg'  => 0,
                'sort_list'    => 1,
                'sort_expense' => -1,    
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 2,
                'name'         => "事業主借",
                'types'        => 2,
                'expense_flg'  => 0,
                'sort_list'    => 2,
                'sort_expense' => -1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 3,
                'name'         => "現金",
                'types'        => 3,
                'expense_flg'  => 0,
                'sort_list'    => 3,
                'sort_expense' => -1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 4,
                'name'         => "その他の預金",
                'types'        => 3,
                'expense_flg'  => 0,
                'sort_list'    => 4,
                'sort_expense' => -1,
                'created_at'   => now(),
                'updated_at'   => now(), 
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 5,
                'name'         => "未払金",
                'types'        => 3,
                'expense_flg'  => 0,
                'sort_list'    => 5,
                'sort_expense' => -1,
                'created_at'   => now(),
                'updated_at'   => now(), 
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 6,
                'name'         => "通信費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 12,
                'sort_expense' => 5,       
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  

            DB::table('fsjs_accounts')->insert([
                'id'           => 7,
                'name'         => "消耗品費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 24,
                'sort_expense' => 10,      
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 8,
                'name'         => "雑費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 25,
                'sort_expense' => 18,      
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 9,
                'name'         => "旅費交通費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 11,
                'sort_expense' => 4,        
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 10,
                'name'         => "損害保険料",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 15,
                'sort_expense' => 8,        
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 11,
                'name'         => "荷造運賃",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 9,
                'sort_expense' => 2,     
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 12,
                'name'         => "売上(収入)",
                'types'        => 2,
                'expense_flg'  => 0,
                'sort_list'    => 7,
                'sort_expense' => -1,     
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 13,
                'name'         => "前払金",
                'types'        => 3,
                'expense_flg'  => 0,
                'sort_list'    => 6,
                'sort_expense' => -1,     
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 14,
                'name'         => "外注工賃",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 20,
                'sort_expense' => 14,     
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 15,
                'name'         => "租税公課",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 8,
                'sort_expense' => 1,     
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 16,
                'name'         => "水道光熱費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 10,
                'sort_expense' => 3,   
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 17,
                'name'         => "広告宣伝費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 13,
                'sort_expense' => 6,  
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 18,
                'name'         => "接待交際費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 14,
                'sort_expense' => 7,    
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 19,
                'name'         => "修繕費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 16,
                'sort_expense' => 9,      
                'created_at'   => now(),
                'updated_at'   => now(), 
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 20,
                'name'         => "利子割引料",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 21,
                'sort_expense' => 15,      
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 21,
                'name'         => "地代家賃",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 22,
                'sort_expense' => 16,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 22,
                'name'         => "貸倒金",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 23,
                'sort_expense' => 17,      
                'created_at'   => now(),
                'updated_at'   => now(),
            ]); 
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 23,
                'name'         => "減価償却費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 17,
                'sort_expense' => 11,   
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 24,
                'name'         => "福利厚生費",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 18,
                'sort_expense' => 12,    
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);  
            
            DB::table('fsjs_accounts')->insert([
                'id'           => 25,
                'name'         => "給料賃金",
                'types'        => 1,
                'expense_flg'  => 1,
                'sort_list'    => 19,
                'sort_expense' => 13,    
                'created_at'   => now(),
                'updated_at'   => now(), 
            ]);  
        });                      
    }
}
