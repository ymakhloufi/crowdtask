<?php

namespace Yama\Assignment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yama\Comment\Comment;
use Yama\Task\Task;
use Yama\User\User;

/**
 * Yama\Assignment\Assignment
 *
 * @property int                                 $id
 * @property int                       $task_id
 * @property int                       $assignee_user_id
 * @property int                       $assigner_user_id
 * @property bool                      $community_rated
 * @property string                    $status
 * @property Carbon                    $created_at
 * @property Carbon                    $updated_at
 * @property Carbon                    $deleted_at
 */
class Assignment extends Model
{
    use SoftDeletes;
    
    public    $timestamps = true;
    protected $dates      = ['deleted_at'];
    protected $fillable   = ['assignee_user_id', 'assigner_user_id', 'task_id', 'approved'];
    
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_user_id');
    }
    
    
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigner_user_id');
    }
    
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    
    public function scopeNew(Builder $query)
    {
        return $query->where('status', 'new');
    }
    
    
    public function scopeRejected(Builder $query)
    {
        return $query->where('status', 'rejected');
    }
    
    
    public function scopeAccepted(Builder $query)
    {
        return $query->where('status', 'accepted');
    }
    
    
    public function scopeFulfilled(Builder $query)
    {
        return $query->where('status', 'fulfilled');
    }
    
    
    public function scopePassed(Builder $query)
    {
        return $query->where('status', 'passed');
    }
    
    
    public function scopeFailed(Builder $query)
    {
        return $query->where('status', 'failed');
    }
    
}
