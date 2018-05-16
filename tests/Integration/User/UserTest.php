<?php

namespace Tests\Integration\User;

use Tests\TestCase;
use Yama\Assignment\Assignment;
use Yama\Tag\Tag;
use Yama\Task\Task;
use Yama\User\User;

class UserTest extends TestCase
{
    public function testTagsRelation()
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


    public function testAssignmentCommentsRelation()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();

        // preconditions
        $this->assertFalse($user->assignmentComments()->exists());

        // action
        $user->writtenComments()->create([
            'text'             => 'My Assignment Comment',
            'commentable_type' => Assignment::class,
            'commentable_id'   => factory(Assignment::class)->create()->id,
        ]);
        $user->writtenComments()->create([
            'text'             => 'My Task Comment',
            'commentable_type' => Task::class,
            'commentable_id'   => factory(Task::class)->create()->id,
        ]);

        // postconditions
        $user->load('writtenComments');
        $this->assertEquals(1, $user->assignmentComments()->count());
        $this->assertEquals('My Assignment Comment', $user->assignmentComments()->first()->text);
    }


    public function testWrittenCommentsRelation()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();

        // preconditions
        $this->assertFalse($user->writtenComments()->exists());

        // action
        $user->writtenComments()->create([
            'text'             => 'My Assignment Comment',
            'commentable_type' => Assignment::class,
            'commentable_id'   => factory(Assignment::class)->create()->id,
        ]);
        $user->writtenComments()->create([
            'text'             => 'My Task Comment',
            'commentable_type' => Task::class,
            'commentable_id'   => factory(Task::class)->create()->id,
        ]);

        // postconditions
        $user->load('writtenComments');
        $this->assertEquals(2, $user->writtenComments()->count());
        $this->assertEquals('My Assignment Comment', $user->writtenComments()->first()->text);
        $this->assertEquals('My Task Comment', $user->writtenComments()->skip(1)->first()->text);
    }


    public function testReceivedAssignments()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();

        // preconditions
        $this->assertFalse($user->receivedAssignments()->exists());

        // action
        $assignment = $user->receivedAssignments()->create([
            'task_id'         => factory(Task::class)->create()->id,
            'community_rated' => true,
            'status'          => 'new',
            'assignee_text'   => '',
        ]);

        // postconditions
        $user->load('receivedAssignments');
        $this->assertEquals(1, $user->receivedAssignments()->count());
        $this->assertEquals($assignment->id, $user->receivedAssignments()->first()->id);
    }


    public function testIssuedAssignments()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();

        // preconditions
        $this->assertFalse($user->issuedAssignments()->exists());

        // action
        $assignment = $user->issuedAssignments()->create([
            'task_id'         => factory(Task::class)->create()->id,
            'community_rated' => true,
            'status'          => 'new',
            'assignee_text'   => '',
        ]);

        // postconditions
        $user->load('issuedAssignments');
        $this->assertEquals(1, $user->issuedAssignments()->count());
        $this->assertEquals($assignment->id, $user->issuedAssignments()->first()->id);
    }


    public function testAuthoredTasks()
    {
        // prepare
        /** @var User $user */
        $user = factory(User::class)->create();

        // preconditions
        $this->assertFalse($user->authoredTasks()->exists());

        // action
        $assignment = $user->authoredTasks()->create([
            'title'       => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ]);

        // postconditions
        $user->load('authoredTasks');
        $this->assertEquals(1, $user->authoredTasks()->count());
        $this->assertEquals($assignment->id, $user->authoredTasks()->first()->id);
    }
}
