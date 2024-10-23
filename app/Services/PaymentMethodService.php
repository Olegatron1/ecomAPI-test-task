<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{
	public function createPaymentMethod(array $data): PaymentMethod
	{
		if (in_array($data['name'], ['paypal', 'payment', 'mirpay'])) {
			$data['payment_url_template'] = $this->generatePaymentUrlTemplate($data['name']);
		} else {
			throw new \InvalidArgumentException('Invalid payment method name.');
		}

		return PaymentMethod::create($data);
	}


	public function updatePaymentMethod(PaymentMethod $paymentMethod, array $data): PaymentMethod
	{
		if (isset($data['name']) && in_array($data['name'], ['paypal', 'payment', 'mirpay'])) {
			$data['payment_url_template'] = $this->generatePaymentUrlTemplate($data['name']);
		}

		$paymentMethod->update($data);

		return $paymentMethod;
	}

	public function deletePaymentMethod(PaymentMethod $paymentMethod): void
	{
		$paymentMethod->delete();
	}

	protected function generatePaymentUrlTemplate(string $name): string
	{
		return "https://$name.example.com/checkout";
	}
}