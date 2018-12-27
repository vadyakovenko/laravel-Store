<?php

use Faker\Generator as Faker;
use App\Entity\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->word,
        'slug' => str_slug($name),
        'is_active' => $faker->boolean,
        'parent_id' => null,
    ];
});
