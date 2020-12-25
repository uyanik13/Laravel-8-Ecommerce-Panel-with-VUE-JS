<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Package;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\Models\Package::class, function (Faker $faker) {


  return [
    'title' => $faker->realText(rand(10,20)),
    'second_title' => $faker->realText(rand(10,20)),
    'description' => '[{"value":"option1"},{"value":"option2"},{"value":"option3"},{"value":"option4"}]',
    'monthly_price' => $faker->numberBetween(5,90),
    'yearly_price' => $faker->numberBetween(90,500),
    'type' => $faker->randomElement(['news','service','profile']),
    'popular' => rand(0,1),
  ];


});


