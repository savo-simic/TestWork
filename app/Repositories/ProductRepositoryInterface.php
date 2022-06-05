<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById($productId);
    public function createProduct(array $data);
    public function updateProduct($productId, array $data);
    public function deleteProduct($productId);
    public function searchProductBy($request);
}
