<?php

namespace Yama\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Yama\Assignment\Assignment;
use Yama\Comment\Comment;
use Yama\Tag\Tag;


// ToDo: Finish property-read doc-blocks

/**
 * User
 *
 * @property-read Tag[]|Collection $tags
 * @property-read Tag[]|Collection $tags
 * @property int                   $id
 * @property string                $email
 * @property string                $password
 * @property string                $name
 * @property string                $gender
 * @property string                $role
 * @property string                $avatar
 * @property string                description
 * @property Carbon                $created_at
 * @property Carbon                $updated_at
 * @property Carbon                $deleted_at
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use SoftDeletes, Notifiable;

    protected $guarded = [];


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withPivot('relation');
    }


    public function assignmentComments(): HasMany
    {
        return $this->comments()->where('commentable_type', 'Assignment');
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function receivedAssignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'assignee_user_id');
    }


    public function issuedAssignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'assigner_user_id');
    }

}
