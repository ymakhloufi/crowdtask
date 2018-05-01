<?php

namespace Yama\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yama\Assignment\Assignment;
use Yama\Attachment\Attachment;
use Yama\Comment\Comment;
use Yama\Tag\Tag;
use Yama\User\User;

/**
 * Yama\Task\Task
 *
 * @property int                          $id
 * @property string                       $title
 * @property string                       $description
 * @property int                          $author_user_id
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 * @property Carbon                       $deleted_at
 */
class Task extends Model
{
    
    protected $table      = 'tasks';
    public    $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates    = ['deleted_at'];
    protected $fillable = ['title', 'description'];
    
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }
    
    
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
}
