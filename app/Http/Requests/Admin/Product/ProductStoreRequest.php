<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'slug' => 'nullable|string|unique:products,slug|max:100',
            'name' => 'required|string|max:100',
            'content' => 'nullable|string|max:500',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5000',
            'price' => 'required|integer',
            'amount' => 'nullable|integer'
        ];
    }
}
