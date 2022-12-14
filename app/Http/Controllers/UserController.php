<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    /**
     * @OA\Post(
     *   path="/api/registration",
     *   summary="User Registration",
     *   description="To Register the User has to enter his details",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"role","first_name","last_name","phoneNumber","email","password","confirm_password"},
     *               @OA\Property(property="role", type="string"),
     *               @OA\Property(property="first_name", type="string"),
     *               @OA\Property(property="last_name", type="string"),
     *               @OA\Property(property="phoneNumber", type="integer"),
     *               @OA\Property(property="email", type="string"),
     *               @OA\Property(property="password", type="string"),
     *               @OA\Property(property="confirm_password", type="string"),
     *   
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=201, description="Data Registered succesfully"),
     *   @OA\Response(response=401, description="The Email has already been registered"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //API for registering user
    public function register(Request $request)
    {
        $userData=User::where('email',$request->email)->first();
        if($userData){
            Log::channel('custom')->info("The Email has already been registered");
        }
        $user=User::create([
            'role'=>$request->role,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'confirm_password'=>bcrypt($request->confirmPassword)
            
        ]);
        
        $token = $user->createToken('Token')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];
        Log::channel('custom')->info("Data Registered succesfully");
        return response($response,201);
    }


    
    /**
     * @OA\Post(
     *   path="/api/login",
     *   summary="User login",
     *   description="login to UI using Mail and Password",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email","password"},
     *               @OA\Property(property="email", type="string"),
     *               @OA\Property(property="password", type="string"),
     *   
     *            ),
     *        ),
     *    ),
     *   @OA\Response(response=200, description="Login success"),
     *   @OA\Response(response=401, description="Invalid credentials"),
     * )
     * 
     *
     * @return \Illuminate\Http\JsonResponse
     */
   

    
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