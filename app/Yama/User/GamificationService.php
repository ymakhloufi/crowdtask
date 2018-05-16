<?php

namespace Yama\User;

use Yama\Assignment\Assignment;

class GamificationService
{
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
