<?php


namespace App\Yama\Gamification;


use Illuminate\Support\Collection;

class BadgeRepository
{
    /**
     * @return Collection|Badge[]
     */
    public function all(): Collection
    {
        return cache()->remember('allBadges', 60, function () {
            $allBadges = new Collection();
            foreach (config('badges') as $category => $badges) {
                foreach ($badges as $title => $badge) {
                    $allBadges->push(new Badge($category, $title, $badge['imageUrl'], $badge['points'], $badge['eval']));
                }
            }

            return $allBadges;
        });
    }
}
