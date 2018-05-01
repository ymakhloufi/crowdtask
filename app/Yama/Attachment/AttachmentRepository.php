<?php

namespace Yama\Attachment;

use Illuminate\Database\Eloquent\Collection;
use Yama\Support\Repository;


/**
 * AttachmentRepository
 *
 * @method Attachment[]|Collection all(array $columns = ['*'])
 * @method Attachment create(array $attributes, boolean $unguard = false)
 * @method Attachment update(array $data, int $id, string $attribute = "id")
 * @method Attachment find(int $id, array $columns = ['*'])
 * @method Attachment findBy(string $attribute, mixed $value, array $columns = ['*'])
 */
class AttachmentRepository extends Repository
{

    function model(): string
    {
        return Attachment::class;
    }
}
