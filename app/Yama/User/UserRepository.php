<?php

namespace Yama\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * UserRepository
 *
 * @method User[]|Model[]|Collection all(array $columns = ['*'])
 * @method User|Model create(array $attributes, boolean $unguard = false)
 * @method User|Model update(array $data, int $id, string $attribute = "id")
 * @method User|Model find(int $id, array $columns = ['*'])
 * @method User|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class UserRepository extends Repository
{

    function model(): string
    {
        return User::class;
    }
}
