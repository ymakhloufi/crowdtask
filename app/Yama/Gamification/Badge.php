<?php

namespace App\Yama\Gamification;

use Yama\User\User;

class Badge
{
    const CATEGORIES = [
        'assigner'  => 'assigner',
        'assignee'  => 'assignee',
        'author'    => 'author',
        'commenter' => 'commenter',
        'rater'     => 'rater',
    ];

    /** @var int */
    public $category;

    /** @var string */
    public $title;

    /** @var string */
    public $imageUrl;

    /** @var int */
    public $points;

    /** @var \Closure */
    public $eval;


    public function __construct(int $category, string $title, string $imageUrl, int $points, \Closure $eval)
    {
        $this->category = $category;
        $this->title    = $title;
        $this->imageUrl = $imageUrl;
        $this->points   = $points;
        $this->eval     = $eval;
    }


    public function userShouldHaveBadge(User $user)
    {
        return ($this->eval)($user);
    }
}
