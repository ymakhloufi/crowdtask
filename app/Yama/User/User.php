<?php

namespace Yama\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Yama\Assignment\Assignment;
use Yama\Comment\Comment;
use Yama\Tag\Tag;


/**
 * Yama\User\User
 *
 * @property int                                 $id
 * @property string                              $email
 * @property string                              $password
 * @property string                              $name
 * @property string                              $gender
 * @property string                              $role
 * @property string                              $avatar
 * @property string                              description
 * @property Carbon                              $created_at
 * @property Carbon                              $updated_at
 * @property Carbon                              $deleted_at
 */
class User extends \Illuminate\Foundation\Auth\User
{
    
    use SoftDeletes, Notifiable;
    
    protected $table = 'users';
    
    public $timestamps = true;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['email', 'name', 'gender', 'role', 'avatar', 'description'];
    
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('relation');
    }
    
    
    public function assignmentComments()
    {
        return Comment::where('commentable_type', 'Assignment')
            ->whereIn('commentable_id', $this->assignments()->pluck('id')->toArray());
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'assignee_user_id');
    }
    
    
    public function issuedAssignments()
    {
        return $this->hasMany(Assignment::class, 'assigner_user_id');
    }
    
}