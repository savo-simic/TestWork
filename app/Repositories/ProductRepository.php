<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\Category;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $product;
    private Category $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product->all();
    }

    /**
     * @param $productId
     * @return Product|null
     * @throws ModelNotFoundException
     */
    public function getProductById($productId): ?Product
    {
        $product = Product::where('id', '=', $productId)->first();

        if (!$product) {
            throw new ModelNotFoundException('model_not_found', trans('ui.product_not_found'), 404);
        }

        return $product;
    }

    /**
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        $category = Category::find($data['category_id']);
        $category->products()->attach($product->id, ['amount' => $data['amount']]);

        return $product;
    }

    /**
     * @param $productId
     * @param array $data
     * @return Product
     * @throws ModelNotFoundException
     */
    public function updateProduct($productId, array $data): Product
    {
        $product = Product::where('id', '=', $productId)->first();

        if (!$product) {
            throw new ModelNotFoundException('model_not_found', trans('ui.product_not_found'), 404);
        }

        $product->update([
            'name' => $data['name'],
            'price' => $data['price']
        ]);

        return $product;
    }

    /**
     * @param $productId
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function deleteProduct($productId): mixed
    {
        $product = Product::where('id', '=', $productId)->first();

        if (!$product) {
            throw new ModelNotFoundException('model_not_found', trans('ui.product_not_found'), 404);
        }

        return $product->delete();
    }

    /**
     * @param $request
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function searchProductBy($request): array|\Illuminate\Database\Eloquent\Collection
    {
        $query = $this->product->query();

        if(request()->has('category_id')) {
            $query->whereHas('categories', function($q) {
                $q->where('category_id', request()->category_id);
            })->get();
        }

        if(request()->has('id')) {
            $query->where('id','LIKE','%'.request()->id.'%');
        }

        if(request()->has('price')) {
            $query->where('price','LIKE','%'.request()->price.'%');
        }

        if(request()->has('name')) {
            $query->where('name','LIKE','%'.request()->name.'%');
        }

        if(request()->has('sortOrderById')) {
            $query->orderBy('id', request()->sortOrderById);
        }

        if(request()->has('sortOrderByPrice')) {
            $query->orderBy('price', request()->sortOrderByPrice);
        }

        return $query->get();
    }
}
