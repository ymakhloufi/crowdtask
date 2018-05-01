<?php

namespace Yama\Task;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * UserRepository
 *
 * @method Task[]|Model[]|Collection all(array $columns = ['*'])
 * @method Task|Model create(array $attributes, boolean $unguard = false)
 * @method Task|Model update(array $data, int $id, string $attribute = "id")
 * @method Task|Model find(int $id, array $columns = ['*'])
 * @method Task|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class TaskRepository extends Repository
{
    
    function model(): string
    {
        return Task::class;
    }
}
