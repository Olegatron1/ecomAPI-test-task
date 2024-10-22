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
			'status' => 'required|in:pending,paid,cancelled',
			'user_id' => 'required|integer',
			'cart_id' => 'required|integer',
			'payment_method_id' => 'required|integer',
			'payment_url' => 'nullable|string',
        ];
    }
}
