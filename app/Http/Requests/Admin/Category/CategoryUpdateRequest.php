<?php

namespace App\Http\Requests\Admin\Category;

use App\Rules\CategoryParent;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $model = $this->route('category');
        return [
            'name' => 'required|string|unique:categories,name,' . $this->category->id . '|max:100',
            'slug' => 'required|string|unique:categories,slug,' . $this->category->id . '|max:100',
            'parent_id' => ['nullable', 'integer', new CategoryParent($model)],
            'content' => 'nullable|string|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5000'
        ];
    }
}
