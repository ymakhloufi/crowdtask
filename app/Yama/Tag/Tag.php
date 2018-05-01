<?php

namespace Yama\Tag;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Yama\Task\Task;
use Yama\User\User;

/**
 * Tag
 *
 * @property int    $id
 * @property string $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Tag extends Model
{
    protected $guarded = [];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

}
