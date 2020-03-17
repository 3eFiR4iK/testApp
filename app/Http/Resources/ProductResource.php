<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'type' => 'product',
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'image' => $this->image,
            ],
            'relationships' => [
                'categories' => [
                    'id' => $this->category->id,
                    'link' => route('categories.show', ['product' => $this->category->id]),
                ],
            ],
        ];
    }
}
