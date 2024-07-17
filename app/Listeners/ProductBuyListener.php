<?php

namespace App\Listeners;

use App\Events\ProductBuy;
use App\Models\Purchase;
use App\Services\ProductService;

class ProductBuyListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly ProductService $productService,
    ) {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductBuy $event): void
    {
        Purchase::create([
            'buyer_uuid' => $event->buyer_uuid,
            'product_name' => $event->product_name,
            'price' => $event->price,
            'seller_uuid' => $event->seller_uuid,
        ]);
        $this->productService->deleteByUUId($event->product_uuid);
    }
}
