<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Models\PasswordReset;
use App\Models\User;
use App\Http\Controllers\BookController;
use App\Models\Book;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::POST('register',[UserController::class,'register']);
Route::POST('login',[UserController::class,'login']);
Route::POST('logout',[UserController::class,'logout']);


Route::POST('changePassword',[PasswordController::class,'changePassword']);
Route::POST('forgotPassword',[PasswordController::class,'forgotPassword']);
Route::POST('resetPassword',[PasswordController::class,'resetPassword']);


Route::POST('addBook',[BookController::class,'addBook']);
Route::GET('displayAllBooks',[BookController::class,'displayAllBooks']);
Route::GET('displayBookByID/{id}',[BookController::class,'displayBookByID']);
Route::POST('updateBookByID/{id}',[BookController::class,'updateBookByID']);
Route::delete('deleteBookByID/{id}',[BookController::class,'deleteBookByID']);
Route::POST('updateBookQuantityByID',[BookController::class,'addQuantity']);

Route::post('searchBook',[BookController::class,'searchBook']);
Route::GET('sortByPriceLowToHigh',[BookController::class,'sorting_Price_LowToHigh']);
Route::GET('sortByPriceHighToLow',[BookController::class,'sorting_Price_HighToLow']);

