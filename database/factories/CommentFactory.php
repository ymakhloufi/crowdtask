<?php

use Faker\Generator as Faker;
use Yama\User\User;

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
$factory->define(Yama\Comment\Comment::class, function (Faker $faker) {
    $commentable = $faker->randomElement([
        \Yama\Task\Task::class,
        \Yama\Assignment\Assignment::class,
    ]);

    return [
        'commentable_id'   => $commentable::inRandomOrder()->first()->id ?? factory($commentable)->create()->id,
        'commentable_type' => $commentable,
        'user_id'          => User::query()->inRandomOrder()->first()->id ?? factory(User::class)->create()->id,
        'text'             => $faker->sentence,
        'rating'           => $faker->randomElement([null, 1, 2, 3, 4, 5]),
    ];
});
