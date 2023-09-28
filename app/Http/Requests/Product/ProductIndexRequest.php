<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => '',
            'name' => '',
            'description' => '',
            'price' => '',
            'discount' => '',
            'argument' => '',
            'sortMode' => '',
            'category_id' => '',
            'importance_rating' => ''
        ];
    }
}
