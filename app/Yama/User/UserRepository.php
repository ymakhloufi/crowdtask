<?php

namespace Yama\User;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * UserRepository
 *
 * @method User[]|Collection all(array $columns = ['*'])
 * @method User create(array $attributes, boolean $unguard = false)
 * @method User update(array $data, int $id, string $attribute = "id")
 * @method User find(int $id, array $columns = ['*'])
 * @method User findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class UserRepository extends Repository
{

    function model(): string
    {
        return User::class;
    }
}
