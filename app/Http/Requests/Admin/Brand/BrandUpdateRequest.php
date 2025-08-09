<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name,' . $this->brand->id . '|max:100',
            'slug' => 'required|string|unique:brands,slug,' . $this->brand->id . '|max:100',
            'content' => 'nullable|string|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5000'
        ];
    }
}
