<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Image;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'phone_number' => 'required|string|unique:users',
            'full_name' => 'required|string',
            'email' => 'sometimes|nullable|string',
            'notification_token' => 'sometimes|nullable|string',
            'image'=>'sometimes|nullable|image|mimes:jpg,png,jpeg|max:5000',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        $user = new User;

        $imagesNames="";

        $user->phone_number=$req->phone_number;
        $user->full_name =$req->full_name;
        $user->email=$req->email;
        $user->notification_token=$req->notification_token;
       

        if($file = $req->file("image")){
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
         $user->image = $imageNames;
        }
        
        //  $user->save();
      
        if($user->save()){
            return response()->json(['success'=>'true','message'=>'Account Create Sucessfully'],200);
        }else{
            return response()->json(['success'=>'false','message'=>'something Went Wrong'],200);
        }


        // $accessToken = $user->createToken('authToken')->accessToken;

        // return response(['user'=> $user, 'access_token'=> $accessToken]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        
        $loginData = $request->validate([
            'phone_number' => 'required|string',
            'password' => 'required|string'
        ]);

        if(!auth()->attempt($loginData)) {
            return response()->json(['success'=>false,'user'=>auth()->user(),'token'=>null,
            'message'=>'Sorry your phone number  or password wrong']);
        }

         $accessToken =auth()->user()->createToken('authToken')->accessToken;

         return response()->json(['success'=>true,'user' =>auth()->user(), 'token' => $accessToken,'message'=>'Success message']);
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
