<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'categories',
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'breadcrumps' => $this->breadcrumps(),
            ],
            'relationships' => [
                'products' => [
                    $this->products->map(function ($product) {
                        return [
                          'id' => $product->id,
                          'link' => route('products.show', ['product' => $product->id]),
                        ];
                    })
                ],
            ],
        ];
    }
}
