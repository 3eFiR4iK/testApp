<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable|integer|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'this field is required'
        ];
    }

}
