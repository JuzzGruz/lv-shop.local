<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name|max:100',
            'slug' => 'nullable|string|unique:categories,slug|max:100',
            'parent_id' => 'nullable|integer',
            'content' => 'nullable|string|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5000'
        ];
    }
}
