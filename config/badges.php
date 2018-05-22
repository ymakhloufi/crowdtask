<?php

use App\Yama\Gamification\Badge;
use Yama\User\User;

return [
    Badge::CATEGORIES['assigner']  => [
        'Wannabe Tutor' => [
            'description' => "Assigned 1 successfully performed assignments.",
            'image'       => "/img/badges/assigner_1.png",
            'points'      => 10,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->exists();
            },
        ],

        'Trainee Tutor' => [
            'description' => "Assigned 5 successfully performed assignments.",
            'image'       => "/img/badges/assigner_5.png",
            'points'      => 50,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 5;
            },
        ],

        'Regular Tutor' => [
            'description' => "Assigned 10 successfully performed assignments.",
            'image'       => "/img/badges/assigner_10.png",
            'points'      => 100,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 10;
            },
        ],

        'Experienced Tutor' => [
            'description' => "Assigned 25 successfully performed assignments.",
            'image'       => "/img/badges/assigner_25.png",
            'points'      => 250,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 25;
            },
        ],

        'Epic Tutor' => [
            'description' => "Assigned 50 successfully performed assignments.",
            'image'       => "/img/badges/assigner_50.png",
            'points'      => 500,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 50;
            },
        ],
    ],
    Badge::CATEGORIES['assignee']  => [
        'Novice Performer' => (object) [
            'description' => "Successfully finished 1 assignment.",
            'image'       => "/img/badges/assignments_1.png",
            'points'      => 10,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->exists();
            },
        ],

        'Junior Performer' => [
            'description' => "Successfully finished 5 assignments.",
            'image'       => "/img/badges/assignments_5.png",
            'points'      => 50,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 5;
            },
        ],

        'Progressive Performer' => [
            'description' => "Successfully finished 10 assignments.",
            'image'       => "/img/badges/assignments_10.png",
            'points'      => 100,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 10;
            },
        ],

        'Senior Performer' => [
            'description' => "Successfully finished 25 assignments.",
            'image'       => "/img/badges/assignments_25.png",
            'points'      => 250,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 25;
            },
        ],

        'Elite Performer' => [
            'description' => "Successfully finished 50 assignments.",
            'image'       => "/img/badges/assignments_50.png",
            'points'      => 500,
            'eval'        => function (User $user) {
                return $user->receivedAssignments()->where('status', 'passed')->count() >= 50;
            },
        ],
    ],
    Badge::CATEGORIES['author']    => [
        'Hobby Author' => [
            'description' => "Successfully submitted 1 task.",
            'image'       => "/img/badges/tasks_1.png",
            'points'      => 25,
            'eval'        => function (User $user) {
                return $user->authoredTasks()->where('status', 'passed')->exists();
            },
        ],

        'Apprentice Author' => [
            'description' => "Successfully submitted 3 tasks.",
            'image'       => "/img/badges/tasks_3.png",
            'points'      => 50,
            'eval'        => function (User $user) {
                return $user->authoredTasks()->where('status', 'passed')->count() >= 3;
            },
        ],

        'Occasional Author' => [
            'description' => "Successfully submitted 6 tasks.",
            'image'       => "/img/badges/tasks_6.png",
            'points'      => 100,
            'eval'        => function (User $user) {
                return $user->authoredTasks()->where('status', 'passed')->count() >= 6;
            },
        ],

        'Professional Author' => [
            'description' => "Successfully submitted 10 tasks.",
            'image'       => "/img/badges/tasks_10.png",
            'points'      => 250,
            'eval'        => function (User $user) {
                return $user->authoredTasks()->where('status', 'passed')->count() >= 10;
            },
        ],

        'Bestselling Author' => [
            'description' => "Successfully submitted 15 tasks.",
            'image'       => "/img/badges/tasks_15.png",
            'points'      => 500,
            'eval'        => function (User $user) {
                return $user->authoredTasks()->where('status', 'passed')->count() >= 15;
            },
        ],
    ],
    Badge::CATEGORIES['commenter'] => [
        'First-Time Commenter' => [
            'description' => "Successfully written 1 comment.",
            'image'       => "/img/badges/commenter_1.png",
            'points'      => 5,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('text')->whereRaw('LENGTH(text) > 0')->exists();
            },
        ],

        'Inexperienced Commenter' => [
            'description' => "Successfully written 10 comments.",
            'image'       => "/img/badges/commenter_10.png",
            'points'      => 25,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('text')->whereRaw('LENGTH(text) > 0')->count() >= 10;
            },
        ],

        'Rising Commenter' => [
            'description' => "Successfully written 25 comments.",
            'image'       => "/img/badges/commenter_25.png",
            'points'      => 50,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('text')->whereRaw('LENGTH(text) > 0')->count() >= 25;
            },
        ],

        'Frequent Commenter' => [
            'description' => "Successfully written 50 comments.",
            'image'       => "/img/badges/commenter_50.png",
            'points'      => 100,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('text')->whereRaw('LENGTH(text) > 0')->count() >= 50;
            },
        ],

        'Heroic Commenter' => [
            'description' => "Successfully written 100 comments.",
            'image'       => "/img/badges/commenter_100.png",
            'points'      => 200,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('text')->whereRaw('LENGTH(text) > 0')->count() >= 100;
            },
        ],
    ],
    Badge::CATEGORIES['rater']     => [
        'Trainee Rater' => [
            'description' => "Successfully rated 1 assignment.",
            'image'       => "/img/badges/rater_1.png",
            'points'      => 5,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('rating')->exists();
            },
        ],

        'Intern Rater' => [
            'description' => "Successfully rated 10 assignments.",
            'image'       => "/img/badges/rater_10.png",
            'points'      => 25,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('rating')->count() >= 10;
            },
        ],

        'Assistance Rater' => [
            'description' => "Successfully rated 25 assignments.",
            'image'       => "/img/badges/rater_25.png",
            'points'      => 50,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('rating')->count() >= 25;
            },
        ],

        'Supervisor Rater' => [
            'description' => "Successfully rated 50 assignments.",
            'image'       => "/img/badges/rater_50.png",
            'points'      => 100,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('rating')->count() >= 50;
            },
        ],

        'Executive Rater' => [
            'description' => "Successfully rated 100 assignments.",
            'image'       => "/img/badges/rater_100.png",
            'points'      => 200,
            'eval'        => function (User $user) {
                return $user->writtenComments()->whereNotNull('rating')->count() >= 100;
            },
        ],
    ],
];

