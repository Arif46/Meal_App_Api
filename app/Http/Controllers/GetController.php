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
use DB;

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
     try{
        $payablesfor = Payable::where('group_id',$group_id)->get();
        $payables = Payable::where('group_id',$group_id)->get();
        $first=$payables[0]->electricity_gas_water;
        $secount=$payables[0]->others;
        $third=$payables[0]->meal_advanced;
        $four=$payables[0]->house_rent;
        $totalsum=$first+$secount+$third+$four;
        return response()->json(['success'=>'true','payables'=>$payablesfor,'totalPayables'=>$totalsum],200);

     }catch(\Exception $e){
        return response()->json(['success'=>'false','payables'=>'null','totalPayables' =>'null'],400);
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

    public function GetallUser()
    {
        $users = DB::table('users')->get();
        return response()->json(['users' => $users],200);

    }

    public function Searchgroup($keyword)
    {
       
        // try{
        //     $group_search = DB::table('groups')
        //     ->where('group_name','LIKE',"%{$keyword}")
        //     ->join('group_members', 'groups.id', '=', 'group_members.group_id')
        //     ->join('users','group_members.phone_number','=','users.phone_number')
        //     ->select('groups.*', 'group_members.*','users.*')
        //     ->get();
        //     $groupmembercount = $group_search->count();
        // return response()->json(['success'=>'true','group_members'=>$group_search,'Total_Member'=>$groupmembercount],200);    
    
        //  }catch(\Exception $e){
        //     return response()->json(['error' => $e->getMessage()]);
        //  }

        $groupsearch=Group::where('group_name','LIKE',"%{$keyword}")->withCount('groupmember')->get();

        if(sizeof($groupsearch) > 0){
            return response()->json(['message'=>'true','groupsearch'=>$groupsearch],200);  
        }else{
            return response()->json(['message'=>'false','groupsearch'=>'group not created'],400);  
        }
      

    }

    public function Membergroup($keyword)
    {
        $membersearch=GroupMember::where('phone_number','LIKE',"%{$keyword}")->with('Admininfo')->get();
        if(sizeof($membersearch) > 0){
            return response()->json(['message'=>'true','Member'=>$membersearch],200);  
        }else{
            return response()->json(['message'=>'false','groupsearch'=>'group member Not created'],400);  
        }
        
    }

    public function Getbazarlist($group_id)
    {
        $bazarlist=Bazar::where('group_id',$group_id)->get();
        if(sizeof($bazarlist) > 0){

            return response()->json(['Success'=>'true','bazarlist'=>$bazarlist],200);

        }else{
            return response()->json(['success'=>'false','message'=>'Something went Wrong'],400);
        }
     

    }

  
  
}
