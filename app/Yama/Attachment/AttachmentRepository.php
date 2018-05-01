<?php

namespace Yama\Attachment;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yama\Support\Repository;


/**
 * AttachmentRepository
 *
 * @method Attachment[]|Model[]|Collection all(array $columns = ['*'])
 * @method Attachment|Model create(array $attributes, boolean $unguard = false)
 * @method Attachment|Model update(array $data, int $id, string $attribute = "id")
 * @method Attachment|Model find(int $id, array $columns = ['*'])
 * @method Attachment|Model findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class AttachmentRepository extends Repository
{
    
    function model(): string
    {
        return Attachment::class;
    }
}
