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

	public function addProductsToCart(Cart $cart, array $data): void
	{
		foreach ($data as $product) {

			$productId = $product['id'] ?? null;
			$quantity = $product['quantity'] ?? 0;

			if ($productId) {
				$cart->products()->attach($productId, ['quantity' => $quantity]);
			}
		}

		$this->updateTotalPrice($cart);
	}

	public function updateTotalPrice(Cart $cart): void
	{
		$cart->load('products');

		$totalPrice = $cart->products->sum(function ($product) {
			return $product->price * $product->pivot->quantity;
		});

		$cart->update(['total_price' => $totalPrice]);
	}

}
