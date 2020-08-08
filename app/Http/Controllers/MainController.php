<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use Validator;

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
            'admin'=>'sometimes|nullable',
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
        $group->admin =$req->admin;

        if($group->save()){
            return response()->json(['success'=>true,'message'=>'group create sucessfully'],200);
        }else{
            return response()->json(['sucess'=>false,'message'=>'something Went Wrong!'],400);
        }


    }
}
