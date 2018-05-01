<?php

namespace Yama\Assignment;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * AssignmentRepository
 *
 * @method Assignment[]|Model[]|Collection all(array $columns = ['*'])
 * @method Assignment|Model create(array $attributes, boolean $unguard = false)
 * @method Assignment|Model update(array $data, int $id, string $attribute = "id")
 * @method Assignment|Model find(int $id, array $columns = ['*'])
 * @method Assignment|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class AssignmentRepository extends Repository
{

    function model(): string
    {
        return Assignment::class;
    }
}
