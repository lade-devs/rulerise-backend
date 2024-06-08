<?php

namespace App\Http\Controllers;

use App\Actions\Product\CreateProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Products\Product;
use App\Support\ApiReturnResponse;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function index() : JsonResponse
    {
        $products = Product::all();

        return ApiReturnResponse::success(ProductResource::collection($products));
    }

    public function store(ProductRequest $request) : JsonResponse
    {

        $product = (new CreateProductAction)->execute($request->all());

        return $product
            ? ApiReturnResponse::success(new ProductResource($product))
            : ApiReturnResponse::failed();
    }

    public function show(string $productId) : JsonResponse
    {
        $product = Product::whereUuid($productId);

        return $product
            ? ApiReturnResponse::success(new ProductResource($product))
            : ApiReturnResponse::notFound('Product does not exist');
    }

    public function update(string $productId, ProductRequest $request) : JsonResponse
    {
        $product = Product::whereUuid($productId);

        if ( ! $product ){
            return ApiReturnResponse::notFound('Product does not exist');
        }

        logger(collect($request->all()));

        $product = (new UpdateProductAction)->execute($product, $request->except(['']));

        return $product
            ? ApiReturnResponse::success(new ProductResource($product))
            : ApiReturnResponse::failed();
    }

    public function delete(string $productId) : JsonResponse
    {
        $product = Product::whereUuid($productId);

        if ( ! $product ){
            return ApiReturnResponse::notFound('Product does not exist');
        }

        return (new DeleteProductAction)->execute($product)
            ? ApiReturnResponse::success()
            : ApiReturnResponse::failed();
    }
}
