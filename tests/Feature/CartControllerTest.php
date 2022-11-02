<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddBookTocartApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('post', '/api/addBookToCart',[
            'book_id'=>1,
            'book_quantity'=>1
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateBookInCartApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" =>'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('post', '/api/updateBookInCart',[
            'id'=>2,
            'book_id'=>1,
            'book_quantity'=>2
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateQuantityInCartApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer 14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('post', '/api/updateQuantityInCart',[
            'id'=>2,
            'book_quantity'=>1
        ]);
        $response->assertStatus(201);
    }

    public function testGetAllBooksApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/displayBooksInCart',[
            'user_id'=>1
        ]);
        $response->assertStatus(201);
    }
 
    // public function testDeleteBookFromCartApi()/////////////////
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('delete', '/api/removeBookFromCart',[
    //         'id'=>1
    //     ]);
    //     $response->assertStatus(200);
    // }
}