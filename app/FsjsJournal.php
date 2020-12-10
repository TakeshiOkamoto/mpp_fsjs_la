<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FsjsJournal extends Model
{
   protected $guarded = array('id');

   public static function Rules()
   {
      return [
          'yyyy' => 'required|integer|min:1989|max:2099',      
          'mm' => 'required|integer|min:1|max:12',  
          'dd' => 'required|integer|min:1|max:31',  
          'debit_account_id'  => 'required|different:credit_account_id',
          'credit_account_id' => 'required',            
          'money' => 'required|integer|min:1|digits_between:1,10', 
          'summary' => 'required|max:50',                     
          ];
   }
}
