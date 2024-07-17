<?php

namespace App\Services;

use App\DTO\ProductDTO\GetProductRequestDTO;
use App\DTO\ProductDTO\PostProductRequestDTO;
use App\DTO\ProductDTO\PutProductRequestDTO;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;

class ProductService
{
    public function create(PostProductRequestDTO $productDTO): ProductResource
    {
        $product = Product::create(Arr::add($productDTO->toArray(), 'user_uuid', auth('api')->user()->uuid));

        return new ProductResource($product);
    }

    public function update(PutProductRequestDTO $productDTO): ProductResource
    {
        $product = $this->findByUUId($productDTO->uuid);
        $product->update(Arr::whereNotNull($productDTO->except('uuid')->toArray()));

        return new ProductResource($product);
    }

    public function deleteByUUId(string $uuid): bool
    {
        $product = $this->findByUUId($uuid);

        return $product->delete();
    }

    public function show(GetProductRequestDTO $productDTO): ProductResource
    {
        $product = $this->findByUUId($productDTO->uuid);

        return new ProductResource($product);
    }

    private function findByUUId(string $uuid): Product
    {
        $product = Product::firstWhere('uuid', '=', $uuid);
        if (is_null($product)) {
            throw new HttpResponseException(response()->json(['Product not found'], 404));
        }

        return $product;
    }

    public function getAllByCategory(string $category_uuid): ProductCollection
    {
        $category = Category::firstWhere('uuid', '=', $category_uuid);

        if (is_null($category)) {
            throw new HttpResponseException(response()->json(['Category not found'], 404));
        }

        return new ProductCollection($category->products());
    }

    public function searchByWord(GetProductRequestDTO $productDTO): ProductCollection
    {
        $products = Product::where('name', 'like', "%$productDTO->search%")->get();

        return new ProductCollection($products);
    }
}
