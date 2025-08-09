<?php

namespace App\Http\Requests\Admin\Page;

use App\Rules\PageParent;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
        $page = $this->route('page');
        return [
            'name' => 'required|max:100',
            'parent_id' => ['required','regex:~^[0-9]+$~', new PageParent($page)],
            'slug' => 'nullable|string|unique:pages,slug,'. $this->page->id .'|max:100',
            'content' => 'required',
        ];
    }
}
