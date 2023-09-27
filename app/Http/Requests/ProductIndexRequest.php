<?php

namespace App\Http\Requests;

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
            'id' => 'string',
            'name' => 'string',
            'description' => 'string',
            'price' => 'string',
            'discount' => 'string',
            'argument' => 'string',
            'sortMode' => 'string',
            'mode' => 'string',
            'category_id' => 'numeric|min:0'
        ];
    }
}
