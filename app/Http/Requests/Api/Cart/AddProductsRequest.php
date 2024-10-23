<?php

namespace App\Http\Requests\Api\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddProductsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		return [
			'products' => 'required|array',
			'products.*' => 'required|array', // Убедитесь, что каждый продукт является массивом
			'products.*.id' => 'required|integer|exists:products,id', // ID продукта должен существовать
			'products.*.quantity' => 'required|integer|min:1', // Количество должно быть больше нуля
		];
    }
}
