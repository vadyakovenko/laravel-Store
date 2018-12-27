<?php

use Illuminate\Database\Seeder;
use App\Entity\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 4)->create()->each(function(Category $category) {
            $counts = [1, random_int(3, 8)];
            $category->children()->saveMany(factory(Category::class, $counts[array_rand($counts)])->create()->each(function(Category $category) {
                $counts = [1, random_int(3, 8)];
                $category->children()->saveMany(factory(Category::class, $counts[array_rand($counts)])->create());
            }));
        });
    }
}
