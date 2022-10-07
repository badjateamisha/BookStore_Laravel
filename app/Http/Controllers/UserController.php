<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    //API for registering user
    public function register(Request $request)
    {
        $data = $request-> validate([
            'role' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string',
            'confirm_password' => 'required|string',
        ]);
        $user = User::create([
            'role' => $data['role'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirm_password' => Hash::make($data['confirm_password'])           
        ]);

        $token = $user->createToken('Token')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        return response($response,201);
    }


   

    
     //API for user login

     public function login(Request $request)
     {
         $data = $request-> validate([
             
             'email' => 'required|email|max:100|',
             'password' => 'required|string',
         ]);
 
         $user = User::where('email',$data['email'])->first();
 
         if(!$user || !Hash::check($data['password'], $user->password))
         {
             return response(['message' => 'Invalid Credentials'], 401);
         }
         else
         {
             $token = $user->createToken('Login')->plainTextToken;
             $response = [
                 'user' => $user,
                 'token' => $token,
             ];
             return response($response, 200);
         }
     }
 


    //API for Logout

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>"User logged out successfully", "SuccessStatus"=>200]);
    }
      
}