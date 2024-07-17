<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequests\DeleteProductRequest;
use App\Http\Requests\ProductRequests\GetProductRequest;
use App\Http\Requests\ProductRequests\PostProductRequest;
use App\Http\Requests\ProductRequests\PutProductRequest;
use App\Services\ProductService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    ) {}

    /**
     * @throws UnknownProperties
     */
    public function store(PostProductRequest $request)
    {
        return response()->json($this->service->create($request->getDto()));
    }

    /**
     * @throws UnknownProperties
     */
    public function show(GetProductRequest $request)
    {
        return response()->json(($this->service->show($request->getDto())));
    }

    /**
     * @throws UnknownProperties
     */
    public function update(PutProductRequest $request)
    {
        return response()->json($this->service->update($request->getDto()));
    }

    /**
     * @throws UnknownProperties
     */
    public function destroy(DeleteProductRequest $request)
    {
        return response()->json(['success' => $this->service->deleteByUUId($request->getDto()->uuid)]);
    }

    /**
     * @throws UnknownProperties
     */
    public function search(GetProductRequest $request)
    {
        return response()->json($this->service->searchByWord($request->getDto()));
    }
}
