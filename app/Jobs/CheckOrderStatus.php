<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderStatus implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected int $orderId;

	/**
	 * Create a new job instance.
	 */
	public function __construct(int $orderId)
	{
		$this->orderId = $orderId;
	}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$order = Order::find($this->orderId);

		if ($order && $order->status === 'pending') {
			$order->update(['status' => 'cancelled']);
		}
	}
}
