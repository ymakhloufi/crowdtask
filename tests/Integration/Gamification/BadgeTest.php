<?php

namespace Tests\Integration\Gamification;

use Tests\TestCase;
use Yama\Tag\Tag;
use Yama\User\User;

class BadgeTest extends TestCase
{
    public function testUserShouldHaveBadge()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();
        $tag  = factory(Tag::class)->create(['title' => 'My Test Tag']);

        // preconditions
        $this->assertFalse($user->tags()->exists());

        // action
        $user->tags()->attach($tag);

        // postconditions
        $user->load('tags');
        $this->assertEquals(1, $user->tags()->count());
        $this->assertEquals('My Test Tag', $user->tags()->first()->title);
    }
}
