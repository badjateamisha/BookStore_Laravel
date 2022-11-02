<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testAddBook()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //         "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('POST', '/api/addBook',[
    //         'name' => 'hello',
    //         'description' => 'Hello world',
    //         'image' => 'hello.PNG',
    //         'author' => 'abc', 
    //         'price' => 250, 
    //         'quantity' => 10,
            
    //     ]);
    //     $response->assertStatus(201);
    // }

    public function testDisplayBooks()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/displayAllBooks',[
            
        ]);
        $response->assertStatus(200);
    }

    // public function testDeleteBookApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('delete', '/api/deleteBookByID/7',[
            
    //     ]);
    //     $response->assertStatus(200);
    // }

    public function testSearchBookApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/searchBook',[
            'value'=>"abcd"
        ]);
        $response->assertStatus(405);
    }

    public function testSortPriceLowToHigh()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            "Authorization" => 'Bearer 14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/sortByPriceLowToHigh',[
            
        ]);
        $response->assertStatus(201);
    }

    public function testSortOnPriceHighToLow()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            "Authorization" => 'Bearer 14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/sortByPriceHighToLow',[
            
        ]);
        $response->assertStatus(201);
    }

    // public function testUpdateQuantityById()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" =>'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/updateBookQuantityByID',[
    //         'id'=>8,
    //         'quantity'=>100
    //     ]);
    //     $response->assertStatus(200);
    // }
}