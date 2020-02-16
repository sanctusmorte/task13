<?php

use Faker\Generator as Faker;
use App\Product;
use App\ProductsInOrder;


$factory->define(App\ProductsInOrder::class, function (Faker $faker) {

	// массив продуктов, который далее будет преобразован в json
	$products = [];

	// добавляем в массив продуктов на каждый заказ от 1 до 15 продуктов
	for ($i = 0; $i < random_int(1, 15) ; $i++) { 

		$product_id = random_int(1, 30);
		$product_data = App\Product::where('id', $product_id)->first();

		$quantity = random_int(1, 20);

		$product = [
			'name' => $product_data['name'],
			'price' => $product_data['price'],
			'quantity' => $quantity,
			'total_price' => $quantity * $product_data['price'],
		];		

		$products[] = $product;
	}

    return [
        'order_id' => $faker->unique(true)->numberBetween(1, 100000),
        'products' => json_encode($products),
    ];
});
