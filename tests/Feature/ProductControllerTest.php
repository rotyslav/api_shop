<?php


use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\User\ValueObjects\Phone;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testCreateProduct(): void
    {
        $user = User::factory()->create();

        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $categoryUUId = Category::factory()->create()->uuid;
        $response     = $this->post('/api/products/create', [
            'name'          => 'name',
            'description'   => 'description',
            'price'         => '777',
            'category_uuid' => $categoryUUId,
            'user_uuid'     => $user->uuid,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'name'          => 'name',
            'description'   => 'description',
            'price'         => '777',
            'category_uuid' => $categoryUUId,
            'user_uuid'     => $user->uuid,
        ]);
    }

    public function testUpdateProduct(): void
    {
        $user = User::factory()->create();

        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $product = Product::factory()->create();
        $this->put("/api/products/update", [
            'uuid'        => $product->uuid,
            'name'        => 'name',
            'description' => 'description',
            'price'       => '777',
        ])->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'uuid'        => $product->uuid,
            'name'        => 'name',
            'description' => 'description',
            'price'       => '777',
        ]);
    }

    public function testDeleteProduct(): void
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $product = Product::factory()->create();
        $this->delete("/api/products/delete", [
            'uuid' => $product->uuid,
        ])->assertStatus(200);
        $this->assertDatabaseMissing('products', [
            'uuid' => $product->uuid,
        ]);
    }

    public function testGetProduct(): void
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);
        $product  = Product::factory()->create();
        $response = $this->post("/api/products/show?uuid=$product->uuid");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'name',
            'description',
            'price',
            'user',
            'uuid',
        ]);
    }

    public function testSearchByWord()
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);
        $product  = Product::factory()->create();
        $response = $this->get("/api/products/search?search=$product->name");
        $response->assertStatus(200);
    }
}
