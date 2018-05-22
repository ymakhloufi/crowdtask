<?php

namespace Yama\User;

use App\Yama\Gamification\Badge;
use App\Yama\Gamification\BadgeRepository;
use Illuminate\Support\Carbon;
use Yama\Assignment\Assignment;

class GamificationService
{
    private $badgeRepository;


    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }


    public function userHasBadge(User $user, Badge $badge): bool
    {
        return $user->getBadges()->where('title', $badge->title)->isNotEmpty();
    }


    public function issueNewBadges(User $user): void
    {
        foreach ($this->badgeRepository->all() as $badge) {
            if (!$this->userHasBadge($user, $badge) and $badge->userShouldHaveBadge($user)) {
                \DB::table('badge_user')->insert([
                    'user_id'     => $user->id,
                    'badge_title' => $badge->title,
                    'created_at'  => Carbon::now(),
                ]);
                $user->points += $badge->points;
                $user->save();
            }
        }
    }


    public function getAverageRating(User $user): ?float
    {
        return $user->receivedAssignments()->whereHas('comments')->get()
            ->map(function (Assignment $assignment) {
                return $assignment->getRating();
            })
            ->filter()// remove NULL values
            ->average();
    }
}
