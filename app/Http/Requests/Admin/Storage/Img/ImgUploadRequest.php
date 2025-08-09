<?php

namespace App\Http\Requests\Admin\Storage\Img;

use Illuminate\Foundation\Http\FormRequest;

class ImgUploadRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,jpg,png|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Дай картинку!',
            'image.mimes' => 'С таким типом картинки не работаю',
            'image.max' => 'Максимум 5 МБ'
        ];
    }
}
