<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FsjsAccount extends Model
{
   protected $guarded = array('id');

   public static function Rules()
   {
      return [
          'name' => 'required|max:20|unique:fsjs_accounts',
          'types' => 'required|min:1|max:3',
          'sort_list' => 'required|integer|max:1000', 
          'sort_expense' => 'required|integer|max:1000',
          ];
   }
}
