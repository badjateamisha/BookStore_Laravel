<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{

    //Api Function to add a book 
    public function addBook(Request $request){
        
        $request-> validate([
            'name' => 'required | string',
            'description' => 'required | string | max:1000',
            'author' => 'required | string', 
            'image' => 'required | string',
            'price' => 'required | integer', 
            'quantity' => 'required | integer',
        ]);


        $getUser = $request->user()->id;
        $book = new Book();
        $book->user_id = $getUser;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->image = $request->image;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
    
        

        $book->save();
        $response = $book;
        return response()->json(['message' => 'Book Added Successfully','book' => $book],201);
        Log::channel('custom')->info("Book is added sucessfully");
    }

    // API Function to display Book
    public function displayAllBooks()
    {
    $book = Book::all();
    if($book)
    {
        return response()->json(['success' => $book],201);
        Log::channel('custom')->info("Books Displayed successfully");

    }
    else
    {
         return response()->json(['Message' => "No Book found to display"],401);
        Log::channel('custom')->info("No Book found to display");
    }
}


    //API Function to display Book by ID
    public function displayBookById($id)
    {
        $book = Book::find($id);
        if($book)
        {
            return response()->json(['success' => $book],201);
            Log::channel('custom')->info("Book Displayed successfully based on ID");
        }
        else
        {
            return response()->json(['Message' => "No Book found with that ID"],401);
            Log::channel('custom')->info("No Book found with that ID");

        }
    }


    //API Function to Update Books by ID
    public function updateBookByID(Request $request, $id)
    {
       
        //validating the data to make it not to be null
        $request-> validate([
            'name' => 'required | string',
            'description' => 'required | string | max:1000',
            'author' => 'required | string', 
            'image' => 'required | string',
            'price' => 'required | integer', 
            'quantity' => 'required | integer',
        ]);

        $book = Book::find($id);
        if($book)
        {
            $book->name = $request->name;
            $book->description = $request->description;
            $book->author = $request->author;
            $book->image = $request->image;
            $book->price = $request->price;
            $book->quantity = $request->quantity;

            
            $book ->update();
            return response()->json(['message'=>'book Updated Successfully'],200);
            Log::channel('custom')->info("Book Updated Successfully");
        }
        else
        {
            return response()->json(['message'=>'No book Found with that ID'],404);
            Log::channel('custom')->info("No book Found with that ID");
        }
      
    }


    //API Function to delete Book by ID
    public function deleteBookByID(Request $request, $id)
    {       
        $book = Book::find($id);
        if($book)
        {
            $book ->delete();
            return response()->json(['message'=>'Data Deleted Successfully'],201);
            Log::channel('custom')->info("Data Deleted Successfully");
        }
        else
        {
            return response()->json(['message'=>'No Book Found with that ID'],401);
            Log::channel('custom')->info("No Book found with that ID");
        }
    }


    //API Function to Update Quantity of Book
    public function addQuantity(Request $request)
    {       
        $request-> validate([ 
            'id' => 'required | integer',
            'quantity' => 'required | integer',
        ]);

        $response = DB::table('books')->where('id', $request->id)->update(['quantity'=>$request->quantity]);
        if($response)
        {            
            return response()->json(['message'=>'Quantity of Books Updated Successfully'],201);
            Log::channel('custom')->info("Quantity of Books Updated Successfully");
        }
        else
        {
            return response()->json(['message'=>'No book Found with that ID'],401);
            Log::channel('custom')->info("No Book found with that ID");
        }
      
    }

    //API function to search book using id/name/author
    public function searchBook(Request $request)
    {
        $request->validate([
            'data' => 'required'
        ]);
    
        $response = DB::table('books')->where('name', $request->data)->
                                    orWhere('id', $request->data)->
                                    orWhere('author', $request->data)->get();
        if($response){
            return response()->json(['success' => $response],201);
            Log::channel('custom')->info("success");
        }
        else{
           return response()->json(['message'=>'No book Found with the entered Value'],401);
           Log::channel('custom')->info("No book Found with the entered Value");
        }
    }

       //API Function to display Books in ascending order

    public function sorting_Price_LowToHigh(){
        $books = Book::select('*')->orderBy("price", "asc")->get();
        
        if($books){
            return response()->json(['success' => $books],201);
            Log::channel('custom')->info("success");
        }
        else{
           return response()->json(['message'=>'No book Found to Display'],401);
           Log::channel('custom')->info("No book Found to Display");
        }
    }

        //API Function to display Books in descending order

    public function sorting_Price_HighToLow(){
        $books = Book::select('*')->orderBy("price", "desc")->get();
        if($books){
            return response()->json(['success' => $books],201);
            Log::channel('custom')->info("success");
        }
        else{
           return response()->json(['message'=>'No book Found to Display'],401);
           Log::channel('custom')->info("No book Found to Display");
        }
    }
}