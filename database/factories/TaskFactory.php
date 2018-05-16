<?php

use Faker\Generator as Faker;
use Yama\Task\Task;

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
$factory->define(Yama\Assignment\Assignment::class, function (Faker $faker) {
    $taskId = Task::query()->inRandomOrder()->pluck('id')->first()
            ?? factory(Task::class)->create()->id;

    return [
        'task_id'          => $taskId,
        'assignee_user_id' => null,
        'assigner_user_id' => null,
        'community_rated'  => true,
        'status'           => 'new',
    ];
});
