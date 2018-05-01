<?php

namespace Yama\Comment;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * CommentRepository
 *
 * @method Comment[]|Model[]|Collection all(array $columns = ['*'])
 * @method Comment|Model create(array $attributes, boolean $unguard = false)
 * @method Comment|Model update(array $data, int $id, string $attribute = "id")
 * @method Comment|Model find(int $id, array $columns = ['*'])
 * @method Comment|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class CommentRepository extends Repository
{

    function model(): string
    {
        return Comment::class;
    }
}
