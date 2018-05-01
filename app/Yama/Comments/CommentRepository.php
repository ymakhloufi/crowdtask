<?php

namespace Yama\Comment;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * CommentRepository
 *
 * @method Comment[]|Collection all(array $columns = ['*'])
 * @method Comment create(array $attributes, boolean $unguard = false)
 * @method Comment update(array $data, int $id, string $attribute = "id")
 * @method Comment find(int $id, array $columns = ['*'])
 * @method Comment findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class CommentRepository extends Repository
{

    function model(): string
    {
        return Comment::class;
    }
}
