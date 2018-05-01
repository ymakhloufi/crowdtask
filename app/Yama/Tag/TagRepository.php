<?php

namespace Yama\Tag;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * TagRepository
 *
 * @method Tag[]|Collection all(array $columns = ['*'])
 * @method Tag create(array $attributes, boolean $unguard = false)
 * @method Tag update(array $data, int $id, string $attribute = "id")
 * @method Tag find(int $id, array $columns = ['*'])
 * @method Tag findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class TagRepository extends Repository
{

    function model(): string
    {
        return Tag::class;
    }
}
