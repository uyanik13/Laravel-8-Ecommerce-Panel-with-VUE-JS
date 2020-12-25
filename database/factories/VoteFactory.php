<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ {
    Vote, Post, User
};
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random(),
        'post_id' => Post::all()->random(),
        'status' => 1
    ];
});
