<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\User\ValueObjects\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $response = $this->post('/api/register', [
            'name'                  => 'name',
            'email'                 => 'email@email.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
            'phone'                 => '0951234567',
        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'email@email.com',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }


    public function testLogin()
    {
        User::factory()->create([
            'email'    => 'email@email.com',
            'password' => 'password',
            'phone'    => Phone::fromString('0951234567'),
        ]);
        $response = $this->post('/api/login', [
            'email'    => 'email@email.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    public function testLogout()
    {
        User::factory()->create([
            'email'    => 'email@email.com',
            'password' => 'password',
            'phone'    => Phone::fromString('0951234567'),
        ]);
        $loginToken = $response = $this->post('/api/login', [
            'email'    => 'email@email.com',
            'password' => 'password',
        ])->baseResponse->original['access_token'];
        $response   = $this->withHeader('Authorization', 'Bearer '.$loginToken)
            ->post('/api/logout');
        $response->assertStatus(200);
    }


}
