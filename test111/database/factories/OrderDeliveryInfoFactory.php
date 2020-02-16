<?php

use Faker\Generator as Faker;

$factory->define(App\OrderDeliveryInfo::class, function (Faker $faker) {
    return [
        'order_id' => $faker->unique(true)->numberBetween(1, 100000),
        'country' => str_random(5,15),
        'city' => str_random(4,10),
        'street' => str_random(6,20),
        'house' => random_int(1, 3),
        'room' => random_int(1, 3),

    ];
});

