<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory contains each of the model factory definitions for
| our application. Factories provide a convenient way to generate new
| model instances for testing / seeding the application's database.
|
*/

//$factory->define(App\Models\User ::class, function (Faker $faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//        'remember_token' => Str::random(10),
//    ];
//});
//
//$factory->define(App\Invoice::class, function (Faker $faker) {
//    return [
//        'user_id' => 1,
//        'invoice_id' => $faker->randomNumber(6),
//        'name' => $faker->sentence(6),
//        'usage_type' =>$faker->randomElement(['m3', 'kWh']),
//        'usage_amount' =>$faker->numberBetween(5,90),
//        'usage_per_price' =>$faker->numberBetween(1,4),
//        'price' =>$faker->randomFloat(1,20),
//        'date_of_invoice' =>$faker->date(now()),
//        'last_date_of_invoice' =>$faker->date(now()),
//        'type' => $faker->randomElement(['water', 'electric']),
//        'status' => $faker->randomElement(['open', 'closed']),
//    ];
//});
