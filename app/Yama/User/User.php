<?php

namespace Yama\User;

use App\Yama\Gamification\Badge;
use App\Yama\Gamification\BadgeRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Yama\Assignment\Assignment;
use Yama\Comment\Comment;
use Yama\Tag\Tag;
use Yama\Task\Task;


/**
 * User
 *
 * @property-read Tag[]|Collection        $tags
 * @property-read Comment[]|Collection    $assignmentComments
 * @property-read Comment[]|Collection    $writtenComments
 * @property-read Assignment[]|Collection $receivedAssignments
 * @property-read Assignment[]|Collection $issuedAssignments
 * @property-read Task[]|Collection       $authoredTasks
 * @property int                          $id
 * @property string                       $email
 * @property string                       $password
 * @property string                       $name
 * @property string                       $gender
 * @property string                       $role
 * @property int                          $points
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

    /** @var null|Collection $badges */
    private $badges = null;


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withPivot('relation');
    }


    public function authoredTasks()
    {
        return $this->hasMany(Task::class, 'author_user_id');
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


    /**
     * @return Collection|Badge[]
     */
    public function getBadges(): Collection
    {
        if ($this->badges === null) {
            $badgeTitles  = \DB::table('badge_user')->where('user_id', $this->id)->pluck('title');
            $this->badges = app(BadgeRepository::class)->all()->whereIn('title', $badgeTitles);
        }

        return $this->badges;
    }
}
