<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

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

/** @noinspection PhpUndefinedVariableInspection */
$factory->define(Yama\Task\Task::class, function (Faker $faker) {
    return [
        'author_user_id' => null,
        'title'          => $faker->sentence,
        'description'    => $faker->sentence,
        'private'        => false,
        'approved_at'    => Carbon::now()->toDateTimeString(),
    ];
});
