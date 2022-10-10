<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PasswordReset;
use App\Models\User;
use App\Mail\sendmail;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;




class PasswordController extends Controller
{

    //API for password changing

    public function changePassword(Request $request){
        $request->validate([
            'email' => 'required',
            'password' =>'required',
            'newPassword' => 'required'
        ]);
        $result = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($result){
            User::where('id', $request->userId)->update(['password' => Hash::make($request->newPassword)]);
            return response()->json(['message'=>"password updated successfully", 'status'=>200]);
            
        }
        else{
            return response()->json(['message'=>"Check your old password", 'status'=>400]);
        }
    }


    //API to change password by sending token to mail

    public function forgotPassword(Request $request)
    {  
        
         $request->validate([
            'email'=>'required | max:200',         
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['Message' => "Email does not exists", 'status' => 404]);
            
        } 
        else {

            $token = Str::random(10);
            $reset = new PasswordReset();

            PasswordReset::create([
                'email' => $request->email,
                'token' => $token
            ]);

            Mail::to($email)->send(new SendMail($token, $email));
            
            return "Token Sent to Mail to Reset Password";
            
        }
    
    }



    
    //API to Reset the Password using Token sent to mail
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'token' => 'required'
        ]);

        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if(!$passwordReset){
            return response()->json(['message' => "Token is invalid "]);
        }

        $user = User::where('email', $passwordReset->email)->first();
        $user->password = Hash::make($request->password);

        PasswordReset::where('email', $request->email)->delete();
        return "password Reset successfull";
      
    }
}