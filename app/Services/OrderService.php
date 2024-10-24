<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;

class OrderService
{
	public function createOrder(array $data): Order
	{
		$cart = Cart::find($data['cart_id']);
		$user = User::find($data['user_id']);
		$paymentMethod = PaymentMethod::find($data['payment_method_id']);

		if ($paymentMethod && $cart && $user) {
			$totalPrice = $cart->total_price;
			$email = $user->email;

			$data['payment_url'] = $this->generatePaymentUrl(
				$paymentMethod->payment_url_template,
				$totalPrice,
				$email
			);

			$order = Order::create($data);

			$order->cart_id = null;
			$order->save();

			$cart->products()->detach();

			$this->deleteCart($cart);

			return $order;
		}

		throw new \Exception('Invalid payment method, cart, or user.');
	}

	protected function generatePaymentUrl(string $template, float $totalPrice, string $email): string
	{
		return "{$template}?total_price={$totalPrice}&email={$email}";
	}

	public function updateOrder(Order $order, array $data): Order
	{
		$order->update($data);
		return $order;
	}

	public function deleteOrder(Order $order): void
	{
		$order->delete();
	}

	public function deleteCart(Cart $cart): void
	{
		$cart->products()->detach();

		$cart->delete();
	}

}
