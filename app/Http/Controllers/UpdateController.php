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

class UpdateController extends Controller
{
    public function updatepayables(Request $request ,$id)
    {
      $update_paybles = Validator::make($request->all(),[
          
          'group_id' => 'required|exists:groups,id',
            'electricity_gas_water' => 'required|integer',
            'others' => 'required|integer',
            'meal_advanced' => 'required|integer',
            'house_rent' => 'required|integer',

      ]);

      if($update_paybles->fails()){
          return response()->json([$update_paybles->errors()],400);
      }

      $update_paybles = New Payable;
      $update_paybles =Payable::findOrFail($id);
      $update_paybles->group_id = $request->group_id;
      $update_paybles->electricity_gas_water =$request->others;
      $update_paybles->meal_advanced=$request->meal_advanced;
      $update_paybles->house_rent = $request->house_rent;

      if($update_paybles->save()){
          return response()->json(['success'=>'true','message' =>'Payables Update Sucessfully'],200);

      }else{
          return response()->json(['success' =>'false','message'=>'something Went Wrong!'],400);
      }
    }

      public function updatedailymealinput(Request $request ,$id)
      {
        $validator = Validator::make($request->all(),[
            'group_id' => 'required|exists:groups,id',
            'breakfast_date_time' => 'required|date_format:Y-m-d H:i:s',
            'lunch_date_time' =>'required|date_format:Y-m-d H:i:s',
            'dinner_date_time' =>'required|date_format:Y-m-d H:i:s',
        ]);

       

        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $update_daily_meal_input = new DailyMealInput;
        $update_daily_meal_input = DailyMealInput::find($id);
        $update_daily_meal_input->group_id=$request->group_id;
        $update_daily_meal_input->breakfast_date_time = $request->breakfast_date_time;
        $update_daily_meal_input->lunch_date_time = $request->lunch_date_time;
        $update_daily_meal_input->dinner_date_time = $request->dinner_date_time;

      if($update_daily_meal_input->save()){
         return response()->json(['success'=> 'true','message' =>'Meal Input  Sucessfully Updated'],200);
      }else{
          return response()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
      }
       

      }
         

    
}
