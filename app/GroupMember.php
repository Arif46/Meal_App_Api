<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
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
         

  
}
