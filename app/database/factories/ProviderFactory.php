<?php

use Faker\Generator as Faker;
use App\Entity\Store\Provider\Provider;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->boolean ? null : $faker->email,
        'phone' => $faker->boolean ? null : $faker->randomElement(['068', '098', '050', '096', '067']) . $faker->numberBetween(1000000, 9999999),
        'url' => $faker->url,
        'conditions' => $faker->boolean ? null : $faker->text,
        'comment' => $faker->boolean ? null : $faker->sentence
    ];
});
