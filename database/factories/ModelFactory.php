<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Measure;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Measure::class, function (Faker $faker) {
    return [
        'temperature' => $faker->numberBetween(0,100),
        'humidity' => $faker->numberBetween(0,100),
        'pressure'=> $faker->numberBetween(800,1500),
    ];
});
