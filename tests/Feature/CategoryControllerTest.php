<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);
        $response = $this->get('/api/')->assertStatus(200);
    }

    public function testCategoryProducts()
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);
        $category = Category::first();
        $this->get("/api/category_products?uuid=$category->uuid")->assertStatus(200);
    }
}
