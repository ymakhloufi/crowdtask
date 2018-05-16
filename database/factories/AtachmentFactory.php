<?php

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

/** @noinspection PhpUndefinedVariableInspection */
$factory->define(Yama\Attachment\Attachment::class, function (Faker $faker) {
    $attachable = $faker->randomElement([
        \Yama\Task\Task::class,
        \Yama\Assignment\Assignment::class,
        \Yama\Comment\Comment::class,
    ]);

    return [
        'attachable_type' => $attachable,
        'attachable_id'   => $attachable::query()->inRandomOrder()->first()->id ?? factory($attachable)->create()->id,
        'path'            => $faker->imageUrl(),
        'filetype'        => $faker->mimeType,
    ];
});
