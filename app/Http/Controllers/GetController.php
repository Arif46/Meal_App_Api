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
use App\Inviation;
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
      $group_list =GroupMember::where('group_id',$group_id)->with('Userinfo')->get();
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

        $groupsearch=Group::where('group_name','LIKE',"%{$keyword}")->with(['admin' => function($query) {
            return $query->select(['group_id','phone_number']);
        }])->withCount('groupmember')->get();

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

    public function Getbazarlist(
    $group_id,
    $from,
    $to )
    {
        $bazarlist=Bazar::where('group_id',$group_id)->whereBetween('date', [$from.' 00:00:00',$to.' 23:59:59'])->get();
        if(sizeof($bazarlist) > 0){

            return response()->json(['Success'=>'true','bazarlist'=>$bazarlist],200);

        }else{
            return response()->json(['success'=>'false','message'=>'Something went Wrong'],400);
        }
     
    }
    public function getallbazarlist(
        $group_id,
        $from,
        $to

    )
    {
        $allbazarlist=Bazar::where('group_id',$group_id)->whereBetween('date', [$from.' 00:00:00',$to.' 23:59:59'])->with('allpayables')->with('user_meal')->with('DailyMealInput')->get();
        
        if (sizeof($allbazarlist) > 0) {

            return response()->json(['Success'=>'true','Allbazarlist'=>$allbazarlist],200);

        }else{
            return response()->json(['success'=>'false','message'=>'Something went Wrong'],400);
        }

    }
  

    public function getallgroupuser($group_id)
    {
        $AllGroupUser=GroupMember::where('group_id',$group_id)->with('group')->get();
        if(sizeof($AllGroupUser) > 0){
            return response()->json(['success'=>'true','AllGroupUser'=>$AllGroupUser],200);
        }else{
            return response()->json(['success'=>'false','message'=>'No Data Found'],400);
        }
    }

    public function getsenderinfo($sender_id)
    {
        $senderinfo=Inviation::where('sender_id',$sender_id)->with('group')->get();
        if(sizeof($senderinfo) > 0){
            return response()->json(['Success'=>'true','Senderinfo'=>$senderinfo],200);
        }else{
            return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        }
        

    }
    public function getreceiverinfo($receiver_id)
    {
        $Receiverinfo=Inviation::where('receiver_id',$receiver_id)->with('group')->get();
        if(sizeof($Receiverinfo) > 0){
            return response()->json(['Success'=>'true','Senderinfo'=>$Receiverinfo],200);
        }else{
            return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        }

    }

    public function updatestatuschange(Request $request,$id)
    {

         // $Updatestatus=Inviation::find($id);
        // if($Updatestatus->status){
        //     $Updatestatus->status = 0;
        // }else{
        //     $Updatestatus->status = 1;
        // }
        // if($Updatestatus->save()){
        //     return response()->json(['success'=>'Inviation status change Sucessfully'],200);
        // }else{
        //     return response()->json(['error'=>'Inviation status change Unsucessfull'],400);
        // }
       
        $Updatestatus=Inviation::find($id);
         $Updatestatus->status=$request->status;             
        if($Updatestatus->save()){
            return response()->json(['success'=>'Inviation status change Sucessfully'],200);
        }else{
            return response()->json(['error'=>'Inviation status change Unsucessfull'],400);
        }
       

    }
    public function getdailymealinput ($group_id)
    {
        $dailymealinputdata =DailyMealInput::where('group_id',$group_id)->get();
        if(sizeof($dailymealinputdata) > 0){
            return response()->json(['Success'=>'true','Dailymealinputdata'=>$dailymealinputdata],200);
        }else{
            return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        }

    }
    public function getgroupuserphonenumber($phone_number)
    {
        $groupuser=GroupMember::where('phone_number',$phone_number)->with('GroupUser')->get();
        if(sizeof($groupuser) > 0){
            return response()->json(['Success'=>'true','GroupUser'=>$groupuser],200);
        }else{
            return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        }

    }

    public function getinviationdatainfo($user_id)
    {
        $inviationdata=Inviation::
          where('sender_id','=',$user_id)
        ->orwhere('receiver_id','=',$user_id)
        ->with('groupinfo')
        ->with('SenderInfo')
        ->with('ReceiverInfo')
        ->get();

        if (sizeof($inviationdata) > 0) {
            return response()->json(['Success'=>'true','Inviationdata'=>$inviationdata],200);
        }else{
            return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        }

    }

    public function getactiveuser($phone_number)
    {

      // $activegroupmember=GroupMember::where('phone_number',$phone_number)->with('ActiveGroup')->get();
        // if (sizeof($activegroupmember) > 0) {
        //     return response()->json(['Success'=>'true','Activegroup'=>$activegroupmember],200);
        // }else{
        //     return response()->json(['Success'=>'false','message'=>'Data Not Found'],400);
        // }

        $members = DB::table('group_members')->where('phone_number', $phone_number)->get();
        $groupInfo = [];
        
        foreach($members as $item) {
            $groupInfo[] = DB::table('groups')->find($item->group_id);
        }

    
        return response()->json(['Success'=>'true','Active_group'=>$groupInfo],200);
    }

    public function gettotalusermeal( $group_id, $from, $to)
    {
        $gettotalmeal=UserMealDate::where('group_id',$group_id)->whereBetween('meal_date', [$from.' 00:00:00',$to.' 23:59:59'])->get(); 
        $gettotalmealcount=$gettotalmeal->count();
        return response()->json(['success'=>'true','Date_Meal'=>$gettotalmeal,'total_meal'=>$gettotalmealcount],200); 

    }

   

 
        

  
}
