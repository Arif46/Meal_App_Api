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
use App\Bazar;
use App\Inviation;

class MainController extends Controller
{
    public function groupcreate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'group_name' => 'required|unique:groups|max:255',
            'address' => 'required|string',
            'cooks_name'=>'sometimes|nullable|string',
            'shopping_type'=>'required|string',
            'meal_type' =>'required|string',
            'is_admin'=>'sometimes|nullable',
        ]);

            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }

        $group = new Group();
        
        $group->group_name=$req->group_name;
        $group->address =$req->address;
        $group->cooks_name =$req->cooks_name;
        $group->shopping_type=$req->shopping_type;
        $group->meal_type=$req->meal_type;
        $group->is_admin =$req->is_admin;

        if($group->save()){
            return response()->json(['success'=>true,'group'=>$group,'message'=>'group create sucessfully'],200);
        }else{
            return response()->json(['sucess'=>false,'message'=>'something Went Wrong!'],400);
        }


    }


    public function postmonthscreate(Request $req)
    {
          $validator=Validator::make($req->all(),[

            'group_id'=>'required|integer|exists:groups,id',
            'is_breakfast_half'=>'required',
            'is_lunch_full' =>'required',
            'is_dinner_full' => 'required',


          ]);

          if($validator->fails()){
              return response()->json($validator->errors(),400);
          }

          $post_month = new PostMonthPricing();

          $post_month->group_id = $req->group_id;
          $post_month->is_breakfast_half =$req->is_breakfast_half;
          $post_month->is_lunch_full =$req->is_lunch_full;
          $post_month->is_dinner_full=$req->is_dinner_full;

          if($post_month->save()){
              return response()->json(['success'=>'true','message'=>'post month upload sucessfully'],200);
          }else{
              return response()->json(['success'=>'false','message'=>'something went Wrong!'],400);
          }


    }

    public function payablescreate(Request $request)
    {
        $payable=Validator::make($request->all(),[
           
            'group_id' => 'required|exists:groups,id',
            'electricity_gas_water' => 'required|integer',
            'others' => 'required|integer',
            'meal_advanced' => 'required|integer',
            'house_rent' => 'required|integer',
        ]);

        if($payable->fails()){
            return response()->json([$payable->errors()],400);
        }


        $payable = new Payable();

        $payable->group_id = $request->group_id;
        $payable->electricity_gas_water =$request->electricity_gas_water;
        $payable->others=$request->others;
        $payable->meal_advanced =$request->meal_advanced; 
        $payable->house_rent =$request->house_rent;

         if($payable->save()){
             return response()->json(['success' =>'true','message'=> 'paybles added succesfully'],200);
         }else{
             return response()->json(['success' =>'false','message' =>'something Went Wrong'],400);
         }

    }

    public function createpreemonths(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'group_id' => 'required|exists:groups,id',
            'breakfast' =>'required',
            'lunch' => 'required',
            'dinner' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $pree_month = new PreeMonthPricing();

        $pree_month->group_id =$request->group_id;
        $pree_month->breakfast =$request->breakfast;
        $pree_month->lunch =$request->lunch;
        $pree_month->dinner =$request->dinner;

        if($pree_month->save()){
            return response()->json(['success'=>'true','message'=>'pree Months Upload SucessFully'],200);
        }else{
            return respoonse()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
        }

    }

    public function postmealinputcreate(Request $req)
    {

        $validator = Validator::make($req->all(),[
            'group_id' => 'required|exists:groups,id',
            'breakfast_date_time' => 'required|date_format:Y-m-d H:i:s',
            'lunch_date_time' =>'required|date_format:Y-m-d H:i:s',
            'dinner_date_time' =>'required|date_format:Y-m-d H:i:s',
        ]);

       

        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $daily_meal_input = new DailyMealInput;

        $daily_meal_input->group_id=$req->group_id;
        $daily_meal_input->breakfast_date_time = $req->breakfast_date_time;
        $daily_meal_input->lunch_date_time = $req->lunch_date_time;
        $daily_meal_input->dinner_date_time = $req->dinner_date_time;

      if($daily_meal_input->save()){
         return response()->json(['success'=> 'true','message' =>'Meal Input  Sucessfully Uploaded'],200);
      }else{
          return response()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
      }
       

    }


    public function groupmemberinsert(Request $request)
    {
       $groupcreate = Validator::make($request->all(),[
           'group_id' => 'required|exists:groups,id',
           'phone_number' => 'required|exists:users,phone_number|unique:group_members,phone_number',
        //    'default_input' =>'required|string',     
       ]);

       if($groupcreate->fails()){
           return response()->json([$groupcreate->errors()],400);
       }

       $group_member = new GroupMember();

       $group_member->group_id =$request->group_id;
       $group_member->phone_number = $request->phone_number;
    //    $group_member->default_input = $request->default_input;
       if($group_member->save()){

           return response()->json(['success' =>'true' ,'message' =>'Group Member Successfully Created'],200);
       }else{
           return response()->json(['success' =>'false','message' =>'Something went Wrong!'],400);
       }

    }


    public function insertusermeal(Request $r)
    {
      $user_meal = Validator::make($r->all(),[
       'group_id' => 'required|exists:groups,id',
       'user_id' => 'required|exists:users,id',
       'phone_number' => 'required|exists:users,phone_number',
       'meal_date' =>'required|date_format:Y-m-d',
       'is_breakfast' => 'sometimes|nullable',
       'is_lunch' =>'sometimes|nullable',
       'is_dinner' => 'sometimes|nullable',
      ]) ;

      if($user_meal->fails()){
          return response()->json([$user_meal->errors()],400);

      }

      $user_meal = new UserMealDate();

      $user_meal->group_id=$r->group_id;
      $user_meal->user_id=$r->user_id;
      $user_meal->phone_number=$r->phone_number;
      $user_meal->meal_date =$r->meal_date;
      $user_meal->is_breakfast =$r->is_breakfast;
      $user_meal->is_lunch =$r->is_lunch;
      $user_meal->is_dinner =$r->is_dinner;


      if($user_meal->save()){

        return response()->json(['success' =>'true' ,'message' =>'User Meal Successfully Created'],200);
    }else{
        return response()->json(['success' =>'false','message' =>'Something went Wrong!'],400);
    }

    }

    public function bazarcreate(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'total_amount' =>'required',
            'date' =>'required|date_format:Y-m-d',
        ]);

       

        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $bazaradd = new Bazar;

        $bazaradd->group_id=$req->group_id;
        $bazaradd->user_id = $req->user_id;
        $bazaradd->total_amount = $req->total_amount;
        $bazaradd->date = $req->date;

      if($bazaradd->save()){
         return response()->json(['success'=> 'true','message' =>'Bazar  Sucessfully Uploaded'],200);
      }else{
          return response()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
      } 

    }

    public function invitaioncreate(Request $req)
    {

        \$validator = Validator::make($req->all(),[
            'group_id' => 'required|exists:groups,id',
            'sender_id' => 'required',
            'receiver_id' =>'required',
            'date' =>'required|date_format:Y-m-d',
        ]);

       
        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $inviationadd = new Inviation;

        $inviationadd->group_id=$req->group_id;
        $inviationadd->sender_id = $req->sender_id;
        $inviationadd->receiver_id = $req->receiver_id;
        $inviationadd->date = $req->date;

      if($inviationadd->save()){
         return response()->json(['success'=> 'true','message' =>' invited Sucessfully Added'],200);
      }else{
          return response()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
      } 

    }
}
