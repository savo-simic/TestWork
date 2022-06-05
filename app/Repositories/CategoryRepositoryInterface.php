<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById($categoryId);
    public function createCategory(array $data);
    public function updateCategory($categoryId, array $data);
    public function deleteCategory($categoryId);
    public function searchCategoryBy($request);
}
