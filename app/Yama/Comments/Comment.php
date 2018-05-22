<?php

namespace Yama\Comment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;
use Yama\Assignment\Assignment;
use Yama\Attachment\Attachment;
use Yama\Task\Task;
use Yama\User\GamificationService;
use Yama\User\User;

/**
 * Comment
 *
 * @property-read Assignment|Comment|Task $comments
 * @property-read User                    $user
 * @property-read Comment[]|Collection    $replies
 * @property-read Attachment[]|Collection $attachments
 * @property-read Assignment|Task         $commentable
 * @property int                          $id
 * @property int                          $user_id
 * @property int                          $commentable_id
 * @property string                       $commentable_type
 * @property string                       $text
 * @property bool                         $rating
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 */
class Comment extends Model
{
    protected $guarded = [];


    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function replies(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }


    public static function boot()
    {
        parent::boot();

        static::created(function (Comment $comment) {
            if ($comment->user_id) {
                app(GamificationService::class)->issueNewBadges($comment->user);
            }
        });
    }

}
