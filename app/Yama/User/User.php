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


/**
 * User
 *
 * @property-read Tag[]|Collection        $tags
 * @property-read Comment[]|Collection    $assignmentComments
 * @property-read Comment[]|Collection    $writtenComments
 * @property-read Assignment[]|Collection $receivedAssignments
 * @property-read Assignment[]|Collection $issuedAssignments
 * @property int                          $id
 * @property string                       $email
 * @property string                       $password
 * @property string                       $name
 * @property string                       $gender
 * @property string                       $role
 * @property string                       $avatar
 * @property string                       description
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 * @property Carbon                       $deleted_at
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use SoftDeletes, Notifiable;

    protected $guarded = ['id', 'password'];


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withPivot('relation');
    }


    public function assignmentComments(): HasMany
    {
        return $this->writtenComments()->where('commentable_type', Assignment::class);
    }


    public function writtenComments(): HasMany
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
