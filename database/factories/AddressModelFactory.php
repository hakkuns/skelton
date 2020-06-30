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
use App\Models\Address;
use App\Models\Customer;

$factory->define(Address::class, function (Faker\Generator $faker) {

    $customer = factory(Customer::class)->create();

    return [
        'alias' => $faker->word,
        'address_1' => $faker->streetAddress,
        'address_2' => null,
        'address_3' => null,
        'zip' => $faker->postcode,
        'customer_id' => $customer->id,
        'status' => 1
    ];
});
