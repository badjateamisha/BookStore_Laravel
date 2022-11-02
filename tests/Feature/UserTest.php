<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    //Testcase case for Successful registration
    // public function testregister()
    // {
    //     $response = $this->json('POST', '/api/register', [
    //         'role' => 'User',            
    //         'first_name' => 'Disha',
    //         'last_name' => 'Badjate',  
    //         'email' => 'disha123@gmail.com',
    //         'password' => 'disha123',   
    //         'confirm_password' => 'disha123'    
    //     ]);
    //     $response->assertStatus(201);
    // }

    // // Testcase for successfull Login
    public function test_login()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
        ->json('POST', '/api/login',
            [
                "email" => "disha123@gmail.com",
                "password" => "disha123"
            ]
        );
        $response->assertStatus(200);
    }

    //Testcase for successfull Logout
    // public function test_Logout()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Application/json',
    //     ])
    //     ->json('POST', '/api/logout', [
    //         "token" => '14|NPJAgE6U9vFira6vGVFJde2OsVtt8lPrFaYkd58L'
    //     ]);

    //     $response->assertStatus(200)->assertJson(['message' => 'User logged out successfully']);
    // }
}