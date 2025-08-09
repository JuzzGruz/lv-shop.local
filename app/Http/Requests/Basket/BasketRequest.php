<?php

namespace App\Http\Requests\Basket;

use Illuminate\Foundation\Http\FormRequest;

class BasketRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'comment' => 'nullable|max:500'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите ваше Имя',
            'email.required' => 'Укажите адрес почты',
            'email.email' => 'Адрес почты должен быть в формате blablabla@mail.ru',
            'phone.required' => 'Укажите телефон',
            'address.required' => 'Укажите адрес доставки',
        ];
    }
}
