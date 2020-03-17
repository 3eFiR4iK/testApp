<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriesResource;

class CategoryController extends Controller
{
    /**
     * @return CategoriesResource
     */
    public function index()
    {
        return new CategoriesResource(Category::all());
    }

    /**
     * @param  Category  $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $node = Category::create(['name' => $request->get('name')]);
        $node->makeChildOf();

        return (new CategoryResource($node))->response();
    }

    /**
     * @param  CategoryRequest  $request
     * @param  Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        CategoryRequest $request,
        Category $category
    ) {
        $category->name = $request->get('name');
        $category->save();
        $category->makeChildOf(Category::find($request->get('parent_id')));


        return (new CategoryResource($category))->response();
    }

    /**
     * @param  Category  $category
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response('', 204);
    }
}
