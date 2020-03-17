<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return ProductsResource
     */
    public function index()
    {
        return new ProductsResource(Product::all());
    }

    /**
     * @param  Product  $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $product = new Product([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category')
        ]);

        if ($request->image) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = public_path('images/products'). $imageName;
        }

        $product->save();

        return (new ProductResource($product))->response();
    }

    /**
     * @param  ProductRequest  $request
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        ProductRequest $request,
        Product $product
    ) {
        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->category_id = $request->get('category');

        if ($request->image) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = 'images/products/'. $imageName;
        }
        $product->save();

        return (new ProductResource($product))->response();
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response('', 204);
    }
}
