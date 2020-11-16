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
use App\Bazar;
use Image;

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
      $update_paybles->electricity_gas_water =$request->electricity_gas_water;
      $update_paybles->others =$request->others;
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

      public function Updateuser(Request $request,$id)
      {

        try{
            $update=Validator::make($request->all(),[

                'email' => 'required|email',
                'notification_token' => 'sometimes|nullable|string',
                'image'=>'required|image|mimes:jpg,png,jpeg|max:5000',
                'active_groupid'=>'sometimes|nullable',
              ]);
    
              if($update->fails()){
                 return response()->json([$update->errors()],400);
              }
    
              $userUpdate = new User;
              $imagesNames="";
              $userUpdate=User::findOrFail($id);
              $userUpdate->email = $request->email;
              $userUpdate->notification_token = $request->notification_token;
    
              if($file = $request->file("image")){
                $images = Image::canvas(600, 600, '#fff');
                $image  = Image::make($file->getRealPath())->resize(600, 600, function($constraint){
                    $constraint->aspectRatio();
                });
                $images->insert($image, 'center');
                $pathImage = date("Y") . '/' . date("m") . '/'.'images/';
                $pathImg = 'Userimage/'.date("Y") . '/' . date("m") . '/'.'images/';;
                $nameReplacer = time().'-'.uniqid(). '.' . $file->getClientOriginalExtension();
                if (!file_exists($pathImg)){
                    mkdir($pathImg, 0777, true);
                    $imageNames  = $pathImage.$nameReplacer;
                    $images->save('Userimage/'.$pathImage.$nameReplacer);
                }
                else{
    
                    $imageNames  = $pathImage.$nameReplacer;
                    $images->save('Userimage/'.$pathImage.$nameReplacer);
                }         
             $userUpdate->image = $imageNames;
            }
            $userUpdate->active_groupid=$request->active_groupid;
    
            if($userUpdate->save()){
                return response()->json(['success' =>'true','message' =>'User Information update Successfully'],200);
            }else{
                return response()->json(['success' =>'false','message' =>'something went Wrong!'],400);
            }
            
    

        }catch(\Exception $e){
            return response()->json(['error' => 'No Data Found'],404);
         }
         


      }



      public function bazarupdate(Request $req,$id)
      {
        $validator = Validator::make($req->all(),[
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
            'total_amount' =>'required',
            'extra_bazar' =>'sometimes|nullable',
        ]);

        if($validator->fails()){
            return response()->json([$validator->errors()],400);
        }

        $bazarUpdate=Bazar::find($id);
        $bazarUpdate->group_id=$req->group_id;
        $bazarUpdate->user_id = $req->user_id;
        $bazarUpdate->total_amount = $req->total_amount;
        $bazarUpdate->extra_bazar = $req->extra_bazar;

      if($bazarUpdate->save()){
         return response()->json(['success'=> 'true','message' =>'Bazar  Update Sucessfully Uploaded'],200);
      }else{
          return response()->json(['success' =>'false' ,'message' =>'Something Went Wrong!'],400);
      } 

      }
         

    
}
