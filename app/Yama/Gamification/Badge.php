<?php

namespace App\Yama\Gamification;

use SuperClosure\Serializer;
use Yama\User\User;

class Badge
{
    const CATEGORIES = [
        'tutor'     => 'tutor',
        'performer' => 'performer',
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

    /** @var string */
    public $serializedEvalFunction;


    public function __construct(string $category, string $title, string $imageUrl, int $points, \Closure $evalFunction)
    {
        $this->category               = $category;
        $this->title                  = $title;
        $this->imageUrl               = $imageUrl;
        $this->points                 = $points;
        $this->serializedEvalFunction = (new Serializer())->serialize($evalFunction);
    }


    public function userShouldHaveBadge(User $user)
    {
        return (new Serializer())->unserialize($this->serializedEvalFunction)($user);
    }
}
