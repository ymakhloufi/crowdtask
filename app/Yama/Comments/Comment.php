<?php

namespace Yama\Comment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yama\User\User;

/**
 * Comment
 *
 * @property int                          $id
 * @property int                          $user_id
 * @property int                          $assignment_id
 * @property string                       $text
 * @property bool                         $rating
 * @property Carbon                       $created_at
 * @property Carbon                       $updated_at
 * @property Carbon                       $deleted_at
 */
class Comment extends Model
{
    public $timestamps = true;
    
    use SoftDeletes;
    
    protected $dates    = ['deleted_at'];
    protected $fillable = ['text', 'rating'];
    
    
    public function commentable()
    {
        return $this->morphTo();
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function replies()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
}
