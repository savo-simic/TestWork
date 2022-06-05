<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category->all();
    }

    /**
     * @param $categoryId
     * @return Category|null
     * @throws ModelNotFoundException
     */
    public function getCategoryById($categoryId): ?Category
    {
        $category = Category::where('id', '=', $categoryId)->first();

        if (!$category) {
            throw new ModelNotFoundException('model_not_found', trans('ui.category_not_found'), 404);
        }

        return $category;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return Category::create([
            'name' => $data['name']
        ]);
    }

    /**
     * @param $categoryId
     * @param array $data
     * @return Category
     * @throws ModelNotFoundException
     */
    public function updateCategory($categoryId, array $data): Category
    {
        $category = Category::where('id', '=', $categoryId)->first();

        if (!$category) {
            throw new ModelNotFoundException('model_not_found', trans('ui.category_not_found'), 404);
        }

        $category->update([
            'name' => $data['name']
        ]);

        return $category;
    }

    /**
     * @param $categoryId
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function deleteCategory($categoryId): mixed
    {
        $category = Category::where('id', '=', $categoryId)->first();

        if (!$category) {
            throw new ModelNotFoundException('model_not_found', trans('ui.category_not_found'), 404);
        }

        return $category->delete();
    }

    /**
     * @param $request
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function searchCategoryBy($request): array|\Illuminate\Database\Eloquent\Collection
    {
        $query = $this->category->query();
        if(request()->has('name')) {
           $query->where('name','LIKE','%'.request()->name.'%');
        }

        if(request()->has('id')) {
            $query->where('id','LIKE','%'.request()->id.'%');
        }

        if(request()->has('sortOrder')) {
            $query->orderBy('id', request()->sortOrder);
        }

        return $query->get();
    }
}
