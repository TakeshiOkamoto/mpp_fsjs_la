<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FsjsCapital extends Model
{
   protected $guarded = array('id');

   public static function Rules()
   {
      return [
          'yyyy' => 'required|integer|min:1989|max:2099|unique:fsjs_capitals',      
          'm1' => 'required|integer|min:0|digits_between:1,10',
          'm2' => 'required|integer|min:0|digits_between:1,10',
          'm3' => 'required|integer|min:0|digits_between:1,10',
          'm4' => 'required|integer|min:0|digits_between:1,10',                    
          ];
   }
}
