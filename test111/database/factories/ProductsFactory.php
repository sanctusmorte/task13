<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => 'Product # ' . random_int(1, 100),
        'price' => random_int(1, 5) * 150,
    ];
});    

