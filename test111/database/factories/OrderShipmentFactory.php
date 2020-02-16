<?php

use Faker\Generator as Faker;

$factory->define(App\OrderShipment::class, function (Faker $faker) {
    return [
        'order_id' => $faker->unique(true)->numberBetween(1, 100000),
        'name' => 'Компания #' . random_int(1, 3000),
        'price' => random_int(3, 10) * 50,
        'delivery_day' => date("d-m-Y", strtotime("+ ".random_int(0, 5)." day")),
    ];
});
