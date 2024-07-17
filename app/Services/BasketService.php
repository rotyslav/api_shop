<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BasketService
{
    public function getAllProducts(): Collection
    {
        return $this->getBasket();
    }

    public function addProduct(string $uuid): void
    {
        $basket = $this->getBasket();
        $basket->put($uuid, Product::where('uuid', '=', $uuid)->first());
        Cache::put(auth('api')->user()->uuid, $basket);
    }

    public function readProduct(string $uuid): ProductResource
    {
        return new ProductResource($this->findProduct($uuid));
    }

    public function deleteProduct(string $uuid): void
    {
        $this->getBasket()->pull($this->findProduct($uuid)->uuid);
    }

    public function clearBasket(): void
    {
        Cache::forget(auth('api')->user()->uuid);
    }

    private function findProduct(string $uuid)
    {
        $product = $this->getBasket()->get($uuid);
        if (is_null($product)) {
            throw new HttpResponseException(response()->json(['Product Not Found'], 404));
        }

        return $product;
    }

    private function getBasket(): Collection
    {
        if (!Cache::has(auth('api')->user()->uuid)) {
            $basket = new Collection();
            Cache::put(auth('api')->user()->uuid, $basket);

            return $basket;
        }

        return Cache::get(auth('api')->user()->uuid);
    }
}
