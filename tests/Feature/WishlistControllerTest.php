<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WishlistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testAddBookToWishlistApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/addBookToWishlist',[
    //         'cart_id'=>2,
    //         'book_id'=>1
    //     ]);
    //     $response->assertStatus(200);
    // }

    public function testDisplayBooksFromWishlists()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/displayBooksFromWishlists',[
        ]);
        $response->assertStatus(201);
    }

    // public function testRemoveBookFromWishlists()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('delete', '/api/removeBookFromWishlists',[
    //         'id'=>3
    //     ]);
    //     $response->assertStatus(201);
    // }

}