<?php

namespace Yama\Attachment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Yama\Comment\Comment;
use Yama\Task\Task;

/**
 * Attachment
 *
 * @property-read Comment|Task         $attachable
 * @property-read Comment[]|Collection $comments
 * @property int                       $id
 * @property int                       $attachable_id
 * @property string                    $attachable_type
 * @property string                    $filename
 * @property string                    $filetype
 * @property Carbon                    $created_at
 * @property Carbon                    $updated_at
 */
class Attachment extends Model
{
    protected $guarded = [];


    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }


    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
