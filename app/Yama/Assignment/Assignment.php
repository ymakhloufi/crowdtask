<?php

namespace Yama\Assignment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Yama\Attachment\Attachment;
use Yama\Comment\Comment;
use Yama\Task\Task;
use Yama\User\GamificationService;
use Yama\User\User;

/**
 * Assignment
 *
 * @property-read Comment[]|Collection    $comments
 * @property-read Attachment[]|Collection $attachments
 * @property-read User                    $assignee
 * @property-read User                    $assigner
 * @property-read Task                    $task
 * @property int                          $id
 * @property int                          $task_id
 * @property int                          $assignee_user_id
 * @property int                          $assigner_user_id
 * @property bool                         $community_rated
 * @property string                       $status
 * @property string                       $assignee_text
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 */
class Assignment extends Model
{
    const STATUS = [
        'new'       => 'new',
        'rejected'  => 'rejected',
        'accepted'  => 'accepted',
        'fulfilled' => 'fulfilled',
        'passed'    => 'passed',
        'failed'    => 'failed',
    ];

    protected $guarded = [];


    /**
     * Attachments added by assignee in order to solve the assignment
     *
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }


    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_user_id');
    }


    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigner_user_id');
    }


    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }


    public function getRating(): ?float
    {
        return $this->comments()->whereNotNull('rating')->getBaseQuery()->average('rating');
    }


    public static function boot()
    {
        parent::boot();

        static::saved(function (Assignment $assignment) {
            if ($assignment->status === Assignment::STATUS['passed']) {
                if ($assignment->assignee_user_id) {
                    app(GamificationService::class)->issueNewBadges($assignment->assignee);
                }
                if ($assignment->assigner_user_id) {
                    app(GamificationService::class)->issueNewBadges($assignment->assigner);
                }
            }
        });
    }
}
