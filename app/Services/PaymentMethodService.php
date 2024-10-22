<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{
	public function createPaymentMethod(array $data): PaymentMethod
	{
		return PaymentMethod::create($data);
	}

	public function updatePaymentMethod(PaymentMethod $paymentMethod, array $data): PaymentMethod
	{
		$paymentMethod->update($data);
		return $paymentMethod;
	}

	public function deletePaymentMethod(PaymentMethod $paymentMethod): void
	{
		$paymentMethod->delete();
	}
}