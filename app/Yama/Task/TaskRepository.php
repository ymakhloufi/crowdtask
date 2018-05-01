<?php

namespace Yama\Task;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * UserRepository
 *
 * @method Task[]|Collection all(array $columns = ['*'])
 * @method Task create(array $attributes, boolean $unguard = false)
 * @method Task update(array $data, int $id, string $attribute = "id")
 * @method Task find(int $id, array $columns = ['*'])
 * @method Task findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class TaskRepository extends Repository
{

    function model(): string
    {
        return Task::class;
    }
}
