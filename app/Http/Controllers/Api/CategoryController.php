<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequests\GetCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ProductService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(CategoryResource::collection(Category::all()));
    }

    /**
     * @throws UnknownProperties
     */
    public function products(GetCategoryRequest $request, ProductService $productService)
    {
        return response()->json($productService->getAllByCategory($request->getDto()->uuid));
    }
}
