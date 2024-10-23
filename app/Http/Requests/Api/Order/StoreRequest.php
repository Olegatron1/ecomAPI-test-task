<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		return [
			'cart_id' => 'required|exists:carts,id',
			'user_id' => 'required|exists:users,id',
			'payment_method_id' => 'required|exists:payment_methods,id',
		];
    }
}
