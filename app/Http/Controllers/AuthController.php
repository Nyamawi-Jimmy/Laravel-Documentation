<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
public function register(Request $request){
    $validator=Validator::make($request->all(),[
        "name"=>["required","string","max:255"],
        "email"=>["required","string","max:255","email","unique:users"],
        "password"=>["required","string","max:8","confirmed",],
    ]);
    if ($validator->fails()){
        return response(["errors"=>$validator->errors()],422);
    }
    $user=User::create([
       "name"=>$request->name,
       "email"=>$request->email,
       "password"=>Hash::make($request->password)
    ]);
    return [
        "message"=>"User Registered Successfully"
    ];
}
public  function  login(Request $request){
    $validator=Validator::make($request->all(),[
       "email"=>["required","email"],
        "password"=>["required",],
    ]) ;

    if ($validator->fails()){
        return response([
             "errors"=>$validator->errors()],422)   ;
    }
     $user=User::where("email" ,$request->email)->first();
    if (!$user || !Hash::check($request->password,$user->password))  {
             return response(["message"=>"Invalid Credentials"]) ;
    }
    return [
        "token"=>$user->createToken(time())->plainTextToken
    ];
}
}
