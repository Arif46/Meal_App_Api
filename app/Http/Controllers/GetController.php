<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Validator;
use App\PostMonthPricing;
use App\Payable;
use App\PreeMonthPricing;
use App\DailyMealInput;
use App\GroupMember;
use App\UserMealDate;
use App\User;

class GetController extends Controller
{
    public function getuser($phone_number)
    {
         $user_information =User::where('phone_number',$phone_number)->get();

         if(count($user_information) > 0) {
             return response()->json(['user' => $user_information],200);
         }else{
             return response()->json(['message' => 'No User Found'],400);
         }

    }

    public function getgroupmember($group_id)
    {
      $group_list =GroupMember::where('group_id',$group_id)->get();
      if(count($group_list) > 0){
          return response()->json(['GroupMembers' => $group_list],200);
      }else{
          return response()->json(['message' => 'No Data Found'],400);
      }
    }

    public function getpayables($group_id)
    {
        $payables = Payable::where('group_id',$group_id)->get();
        if(sizeof($payables) > 0) {
            return response()->json(['Payables' => $payables],200);
        }else{
            return response()->json(['message' =>'No Data Found!'],400);
        }

    }
    public function getusermealdate($date)
    {
     
        $user_meal =UserMealDate::where('meal_date',$date)->get();
        if(sizeof($user_meal) >0 ){
            return response()->json(['UserMeals' => $user_meal],200);

        }else{
            return response()->json(['message' =>'No Data Found'],400);
        }

    }
  
}
