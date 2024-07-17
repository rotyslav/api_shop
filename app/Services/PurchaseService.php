<?php

namespace app\Services;

use App\Events\ProductBuy;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Event;

class PurchaseService
{
    public function buyItem(string $uuid): void
    {
        try {
            $product = Product::where('uuid', $uuid)->firstOrFail();
            Event::dispatch(new ProductBuy(
                auth('api')->user()->uuid,
                $product->name,
                $product->price,
                $product->user_uuid));
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->json($exception->getMessage(), 404));
        }
    }
}
