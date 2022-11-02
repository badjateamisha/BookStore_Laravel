<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testPlaceOrderApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //         "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/placeOrder',[
    //             'cartId_json' => [2],
    //             'address_id' => 1
    //     ]);
    //     $response->assertStatus(500);
    // }

    // public function testCancelOrderApi()//////////
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/cancelOrder',[
    //             'order_id'=>'3'
    //     ]);
    //     $response->assertStatus(200);
    // }

}