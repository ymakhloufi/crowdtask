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
use Yama\Gamification\BadgeRepository;
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

    /** @var null|array */
    private $statistics = null;


    public function setPassword(string $password, bool $saving = true)
    {
        $this->password = bcrypt($password);

        if ($saving) {
            $this->save();
        }
    }


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
     * @return Collection|\Yama\Gamification\Badge[]
     */
    public function getBadges(): Collection
    {
        if ($this->badges === null) {   // cache the result for using this during the same request
            $badgeTitles  = \DB::table('badge_user')->where('user_id', $this->id)->pluck('badge_title');
            $this->badges = app(BadgeRepository::class)->all()->whereIn('title', $badgeTitles);
        }

        return $this->badges;
    }


    public function getStatistics(): array
    {
        // Using the collections here was significantly faster than the query-builder.
        // I assume because we avoid the repeated overhead of talking to the database.
        if ($this->statistics === null) {   // cache the result for using this during the same request
            $this->statistics = [
                'authoredTasks'       => [
                    'approved' => $this->authoredTasks->where('approved_at', '!==', null)->count(),
                    'pending'  => $this->authoredTasks->where('approved_at', '===', null)->count(),
                    'all'      => $this->authoredTasks->count(),
                ],
                'issuedAssignments'   => [
                    'new'       => $this->issuedAssignments->where('status', 'new')->count(),
                    'accepted'  => $this->issuedAssignments->where('status', 'accepted')->count(),
                    'rejected'  => $this->issuedAssignments->where('status', 'rejected')->count(),
                    'fulfilled' => $this->issuedAssignments->where('status', 'fulfilled')->count(),
                    'passed'    => $this->issuedAssignments->where('status', 'passed')->count(),
                    'failed'    => $this->issuedAssignments->where('status', 'failed')->count(),
                    'all'       => $this->issuedAssignments->count(),
                ],
                'receivedAssignments' => [
                    'new'       => $this->receivedAssignments->where('status', 'new')->count(),
                    'accepted'  => $this->receivedAssignments->where('status', 'accepted')->count(),
                    'rejected'  => $this->receivedAssignments->where('status', 'rejected')->count(),
                    'fulfilled' => $this->receivedAssignments->where('status', 'fulfilled')->count(),
                    'passed'    => $this->receivedAssignments->where('status', 'passed')->count(),
                    'failed'    => $this->receivedAssignments->where('status', 'failed')->count(),
                    'all'       => $this->receivedAssignments->count(),
                ],
                'writtenComments'     => [
                    'tasks'       => $this->writtenComments->where('commentable_type', Task::class)->count(),
                    'assignments' => $this->writtenComments->where('commentable_type', Assignment::class)->count(),
                    'comments'    => $this->writtenComments->where('commentable_type', Comment::class)->count(),
                    'all'         => $this->writtenComments->count(),
                ],
            ];
        }

        return $this->statistics;
    }
}
