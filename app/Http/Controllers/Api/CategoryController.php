<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ModelNotFoundException;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    protected ?CategoryRepositoryInterface $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Get a list of all categories
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = $this->category->getAllCategories();

        return CategoryResource::collection($categories);
    }

    /**
     * Create a new category
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $category = $this->category->createCategory($request->all());

        return new CategoryResource($category);
    }

    /**
     * Show Category by id
     *
     * @param $id
     * @return CategoryResource
     * @throws ModelNotFoundException
     */
    public function show($id): CategoryResource
    {
        $category = $this->category->getCategoryById($id);

        return new CategoryResource($category);
    }

    /**
     *  Update Category by id
     *
     * @param CategoryRequest $request
     * @param $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $category = $this->category->updateCategory($id, $request->all());

        return response()->json([
            'data' =>
                new CategoryResource($category->fresh())], 200);
    }

    /**
     * Delete Category by id
     *
     * @param $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function destroy($id): JsonResponse
    {
        $this->category->deleteCategory($id);

        return response()->json([
            'message_key'  => 'delete_success',
            'message_text' => 'Category successfully deleted.']);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function search(): AnonymousResourceCollection
    {
        $category = $this->category->searchCategoryBy(request()->all());

        return CategoryResource::collection($category);
    }
}
