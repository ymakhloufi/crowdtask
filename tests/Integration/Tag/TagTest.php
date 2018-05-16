<?php

namespace Tests\Integration\Tag;

use Tests\TestCase;
use Yama\Tag\Tag;
use Yama\Task\Task;
use Yama\User\User;

class TagTest extends TestCase
{
    public function testUsersRelation()
    {
        // prepare
        /** @var Tag $tag */
        $tag  = factory(Tag::class)->create();
        $user = factory(User::class)->create(['name' => 'My Test User']);

        // preconditions
        $this->assertFalse($tag->users()->exists());

        // action
        $tag->users()->attach($user);

        // postconditions
        $tag->load('users');
        $this->assertEquals(1, $tag->users()->count());
        $this->assertEquals('My Test User', $tag->users()->first()->name);
    }


    public function testTasksRelation()
    {
        // prepare
        /** @var Tag $tag */
        $tag  = factory(Tag::class)->create();
        $task = factory(Task::class)->create(['title' => 'My Test Task']);

        // preconditions
        $this->assertFalse($tag->tasks()->exists());

        // action
        $tag->tasks()->attach($task);

        // postconditions
        $tag->load('tasks');
        $this->assertEquals(1, $tag->tasks()->count());
        $this->assertEquals('My Test Task', $tag->tasks()->first()->title);
    }
}
