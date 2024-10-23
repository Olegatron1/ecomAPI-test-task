<?php

namespace App\Console\Commands;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Console\Command;

class go extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
	public function handle()
	{
		// Находим корзину с идентификатором 1
		$cart = Cart::find(1);
		$productsWithQuantity = [
			4 => ['quantity' => 2], // Для продукта с ID 4 количество 2
			5 => ['quantity' => 3], // Для продукта с ID 5 количество 3
			6 => ['quantity' => 1], // Для продукта с ID 6 количество 1
		];
		$cart->products()->attach($productsWithQuantity);
	}
}
