<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testAddAddressApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //         "Authorization" =>'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/addAddress',[
    //             "address" => 'Backyard farms',
    //             "landmark" => "Near golf club",
    //             "city" => "Mumbai",
    //             "state" => "Maharashtra",
    //             "pincode" => "24680",
    //             "address_type" => "Office"
    //     ]);
    //     $response->assertStatus(201);
    // }

    // public function testUpdateAddressApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //         "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('post', '/api/updateAddressById',[
    //             'id'=>2,
    //             "address" => 'Backyard palms',
    //             "landmark" => "Near golf club",
    //             "city" => "Mumbai",
    //             "state" => "Maharashtra",
    //             "pincode" => "24680",
    //             "address_type" => "Office"
    //     ]);
    //     $response->assertStatus(201);
    // }

    public function testGetAllAddressesApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
            ])->json('get', '/api/displayAllAddresses',[
               
        ]);
        $response->assertStatus(201);
    }

    // public function testDeleteAddressApi()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Appilication/json',
    //          "Authorization" => 'Bearer  14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //         ])->json('delete', '/api/deleteAddressByID',[
    //            'id'=>2
    //     ]);
    //     $response->assertStatus(201);
    // }
}