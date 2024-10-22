<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $guarded = false;

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function cart(): BelongsTo
	{
		return $this->belongsTo(Cart::class);
	}

	public function paymentMethod(): BelongsTo
	{
		return $this->belongsTo(PaymentMethod::class);
	}
}
