<?php

namespace Yama\Assignment;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * AssignmentRepository
 *
 * @method Assignment[]|Collection all(array $columns = ['*'])
 * @method Assignment create(array $attributes, boolean $unguard = false)
 * @method Assignment update(array $data, int $id, string $attribute = "id")
 * @method Assignment find(int $id, array $columns = ['*'])
 * @method Assignment findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class AssignmentRepository extends Repository
{

    function model(): string
    {
        return Assignment::class;
    }
}
