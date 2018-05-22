<?php

namespace Yama\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Yama\Assignment\Assignment;
use Yama\Attachment\Attachment;
use Yama\Comment\Comment;
use Yama\Tag\Tag;
use Yama\User\GamificationService;
use Yama\User\User;

/**
 * Task
 *
 * @property-read User                    $author
 * @property-read Comment[]|Collection    $comments
 * @property-read Tag[]|Collection        $tags
 * @property-read Attachment[]|Collection $attachments
 * @property-read Assignment[]|Collection $assignments
 * @property int                          $id
 * @property string                       $title
 * @property string                       $description
 * @property int                          $author_user_id
 * @property bool                         $private
 * @property Carbon                       $approved_at
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 */
class Task extends Model
{
    protected $guarded = [];
    protected $dates   = ['created_at', 'updated_at', 'approved_at'];


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }


    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }


    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public static function boot()
    {
        parent::boot();

        static::saved(function (Task $task) {
            if ($task->approved_at and $task->author_user_id) {
                app(GamificationService::class)->issueNewBadges($task->author);
            }
        });
    }

}
