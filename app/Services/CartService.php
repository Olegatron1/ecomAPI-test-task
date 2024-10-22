<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
	public function createCart(array $data): Cart
	{
		return Cart::create($data);
	}

	public function updateCart(Cart $cart, array $data): Cart
	{
		$cart->update($data);
		return $cart;
	}

	public function deleteCart(Cart $cart): void
	{
		$cart->delete();
	}
}
