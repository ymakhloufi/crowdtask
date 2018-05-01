<?php

namespace Yama\Tag;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Yama\Task\Task;
use Yama\User\User;

/**
 * Yama\Tag\Tag
 *
 * @property int                    $id
 * @property string                 $title
 * @property Carbon                 $created_at
 * @property Carbon                 $updated_at
 */
class Tag extends Model
{
    
    protected $table      = 'tags';
    public    $timestamps = true;
    protected $fillable   = ['title'];
    
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    
}
