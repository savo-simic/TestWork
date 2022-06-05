<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ModelNotFoundException;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    protected ?ProductRepositoryInterface $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Get a list of all products
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = $this->product->getAllProducts();

        return ProductResource::collection($products);
    }

    /**
     * Create a new product
     *
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
       $product = $this->product->createProduct($request->all());

        return new ProductResource($product);
    }

    /**
     * Show Product by id
     *
     * @param $id
     * @return ProductResource
     */
    public function show($id): ProductResource
    {
        $product = $this->product->getProductById($id);

        return new ProductResource($product);
    }

    /**
     *  Update Product by id
     *
     * @param ProductRequest $request
     * @param $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function update(ProductRequest $request, $id): JsonResponse
    {

        $product = $this->product->updateProduct($id, $request->all());

        return response()->json([
            'data' =>
                new ProductResource($product->fresh())], 200);
    }

    /**
     * Delete Product by id
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->product->deleteProduct($id);

        return response()->json([
            'message_key'  => 'delete_success',
            'message_text' => 'Product successfully deleted.']);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function search(): AnonymousResourceCollection
    {
        $product = $this->product->searchProductBy(request()->all());

        return ProductResource::collection($product);
    }
}
