<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 2)->create()->each(function (Category $category) {
            factory(Product::class, 6)->make()->each(function(Product $product) use ($category) {
                $category->products()->save($product);
            });
        });
    }
}