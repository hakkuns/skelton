<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Category;
use Illuminate\Http\UploadedFile;

$factory->define(Category::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->randomElement([
        'Cat1',
        'Cat2',
        'Cat3',
        'Cat4'
    ]);

    $file = UploadedFile::fake()->image('category.png', 600, 600);

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph,
        'cover' => $file->store('categories', ['disk' => 'public']),
        'status' => 1
    ];
});
