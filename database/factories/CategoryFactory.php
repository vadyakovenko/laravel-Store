<?php

use Faker\Generator as Faker;
use App\Entity\Store\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->word,
        'slug' => str_slug($name),
        'is_active' => $faker->boolean,
        'parent_id' => null,
        'seo_json' => json_encode(['title' => $name, 'description' => $faker->sentence, 'keywords' => $faker->word ])
    ];
});
