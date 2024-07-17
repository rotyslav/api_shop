<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\GetProductRequest;
use App\Services\BasketService;
use App\Services\PurchaseService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function buyProduct(GetProductRequest $request, PurchaseService $purchaseService)
    {
        $purchaseService->buyItem($request->getDto()->uuid);
    }

    public function buyProductsFromBasket(BasketService $basketService, PurchaseService $purchaseService)
    {
        foreach ($basketService->getAllProducts() as $product) {
            $purchaseService->buyItem($product->uuid);
        }
        $basketService->clearBasket();
    }
}
