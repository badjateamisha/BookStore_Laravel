<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Models\PasswordReset;
use App\Models\User;
use App\Http\Controllers\BookController;
use App\Models\Book;
use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Http\Controllers\WishlistController;
use App\Models\Wishlist;
use App\Http\Controllers\AddressController;
use App\Models\Address;
use App\Http\Controllers\OrderController;
use App\Models\order;



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

Route::middleware(['auth:sanctum'])->group(function(){


Route::POST('addBook',[BookController::class,'addBook']);
Route::GET('displayAllBooks',[BookController::class,'displayAllBooks']);
Route::GET('displayBookByID/{id}',[BookController::class,'displayBookByID']);
Route::POST('updateBookByID/{id}',[BookController::class,'updateBookByID']);
Route::delete('deleteBookByID/{id}',[BookController::class,'deleteBookByID']);
Route::POST('updateBookQuantityByID',[BookController::class,'addQuantity']);

Route::Post('searchBook',[BookController::class,'searchBook']);
Route::GET('sortByPriceLowToHigh',[BookController::class,'sorting_Price_LowToHigh']);
Route::GET('sortByPriceHighToLow',[BookController::class,'sorting_Price_HighToLow']);

Route::Post('addBookToCart',[CartController::class, 'addBookTocart']);
Route::Get('displayBooksInCart',[CartController::class, 'displayBooksInCart']);
Route::Post('updateBookInCart',[CartController::class, 'updateBookInCart']);
Route::Post('updateQuantityInCart',[CartController::class, 'updateQuantityInCart']);
Route::Delete('removeBookFromCart',[CartController::class, 'removeBookFromCart']);

Route::post('addBookToWishlist', [WishlistController::class, 'addBookToWishlist']);
Route::get('displayBooksFromWishlists', [WishlistController::class, 'displayBooksFromWishlists']);
Route::delete('removeBookFromWishlists', [WishlistController::class, 'removeBookFromWishlists']);

Route::post('addAddress', [AddressController::class, 'addAddress']);
Route::post('updateAddressById', [AddressController::class, 'update_Address_Id']);
Route::get('displayAllAddresses', [AddressController::class, 'display_AllAddresses']);
Route::delete('deleteAddressByID', [AddressController::class, 'delete_Address_ID']);

Route::get('getBookById', [OrderController::class, 'getBookById']);
Route::post('placeOrder', [OrderController::class, 'placeOrder']);
Route::post('cancelOrder', [OrderController::class, 'cancelOrder']);
    
});