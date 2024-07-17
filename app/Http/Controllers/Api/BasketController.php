<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\GetProductRequest;
use App\Http\Resources\ProductCollection;
use App\Services\BasketService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class BasketController extends Controller
{
    public function __construct(
        readonly private BasketService $service
    ) {}

    public function products()
    {
        return response()->json(new ProductCollection($this->service->getAllProducts()));
    }

    /**
     * @throws UnknownProperties
     */
    public function add(GetProductRequest $request)
    {
        $this->service->addProduct($request->getDto()->uuid);
    }

    /**
     * @throws UnknownProperties
     */
    public function get(GetProductRequest $request)
    {
        return response()->json($this->service->readProduct($request->getDto()->uuid));
    }

    /**
     * @throws UnknownProperties
     */
    public function delete(GetProductRequest $request)
    {
        $this->service->deleteProduct($request->getDto()->uuid);
    }

    public function clear()
    {
        $this->service->clearBasket();
    }
}
