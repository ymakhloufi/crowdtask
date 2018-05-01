<?php

namespace Yama\Tag;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * TagRepository
 *
 * @method Tag[]|Model[]|Collection all(array $columns = ['*'])
 * @method Tag|Model create(array $attributes, boolean $unguard = false)
 * @method Tag|Model update(array $data, int $id, string $attribute = "id")
 * @method Tag|Model find(int $id, array $columns = ['*'])
 * @method Tag|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class TagRepository extends Repository
{
    
    function model(): string
    {
        return Tag::class;
    }
}
