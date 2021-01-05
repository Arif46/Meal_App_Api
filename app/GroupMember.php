<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{

      protected $table ="group_members";

      protected $fillable = [
            'group_id','phone_number','default_input',''
      ];
//  public function Admininfo()
//  {
//      return $this->hasMany('App\User','phone_number','phone_number');
//  }
         public function group()
         {
            return $this->hasMany('App\Group','id','group_id'); 
         }
         public function Userinfo()
         {
            return $this->hasMany('App\User','phone_number','phone_number');
         }
         public function GroupUser()
         {
            return $this->hasMany('App\Group','id','group_id');
         }
         public function ActiveGroup()
         {
            return $this->hasMany('App\Group','id','group_id');
         }
         public function allpayables()
         {
            return $this->hasMany('App\Payable','group_id','group_id');
         }
         public function user_meal()
         {
            return $this->hasMany('App\UserMealDate','group_id','group_id');
         }
         public function DailyMealInput()
         {
            return $this->hasMany('App\DailyMealInput','group_id','group_id');
         }
         public function PostMonthPricing()
         {
            return $this->hasMany('App\PostMonthPricing','group_id','group_id');
         }
         public function PreeMonthPricing()
         {
            return $this->hasMany('App\PreeMonthPricing','group_id','group_id');
         }
         public function groupinfo()
         {
            return $this->belongsTo('App\Group','group_id','id');
         }
         public function User()
         {
            return $this->hasMany('App\User','phone_number','phone_number');
         }

         public function preemonth()
         {
            return $this->hasMany('App\PreeMonthPricing','group_id','group_id')->selectRaw('sum(breakfast) as breakfast, sum(lunch) as lunch, sum(dinner) as dinner,group_id')->groupBy('group_id');
         }

         public function postMonth()
         {
            return $this->hasMany('App\PostMonthPricing','group_id','group_id')->selectRaw('sum(is_breakfast_half) as breakfast, sum(is_lunch_full) as lunch, sum(is_dinner_full) as dinner,group_id')->groupBy('group_id');
         }
        
         public function userMeal()
         {
            return $this->hasMany('App\UserMealDate','group_id','group_id')->selectRaw('sum(is_breakfast) as breakfast, sum(is_lunch) as lunch, sum(is_dinner) as dinner,group_id')->groupBy('group_id');;
         }

         public function group_info()
         {
            return $this->hasMany('App\Group','id','group_id');
         }
       
  
}
