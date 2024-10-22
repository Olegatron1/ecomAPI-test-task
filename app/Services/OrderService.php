<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{

	public function createOrder(array $data): Order
	{
		return Order::create($data);
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
}
