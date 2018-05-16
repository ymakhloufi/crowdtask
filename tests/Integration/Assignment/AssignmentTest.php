<?php

namespace Tests\Acceptance\Auth;

use Tests\TestCase;
use Yama\Assignment\Assignment;
use Yama\Task\Task;
use Yama\User\User;

class AssignmentTest extends TestCase
{
    public function testAttachmentsRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        $assignment = factory(Assignment::class)->create();

        // preconditions
        $this->assertFalse($assignment->attachments()->exists());

        // action
        $assignment->attachments()->create(['path' => '/somewhere/file.jpeg', 'filetype' => 'image/jpeg']);

        // postconditions
        $assignment->load('attachments');
        $this->assertEquals(1, $assignment->attachments()->count());
        $this->assertEquals('/somewhere/file.jpeg', $assignment->attachments()->first()->path);
        $this->assertEquals('image/jpeg', $assignment->attachments()->first()->filetype);
    }


    public function testCommentsRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        $assignment = factory(Assignment::class)->create();

        // preconditions
        $this->assertFalse($assignment->comments()->exists());

        // action
        $assignment->comments()->create(['text' => 'some comment']);

        // postconditions
        $assignment->load('comments');
        $this->assertEquals(1, $assignment->comments()->count());
        $this->assertEquals('some comment', $assignment->comments()->first()->text);
    }


    public function testAssigneeRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        /** @var User $assignee */
        $assignment = factory(Assignment::class)->create();
        $assignee   = factory(User::class)->create();

        // preconditions
        $this->assertFalse($assignment->assignee()->exists());

        // action
        $assignment->assignee()->associate($assignee);

        // postconditions
        $assignment->load('assignee');
        $this->assertTrue($assignment->assignee()->exists());
        $this->assertEquals($assignee->id, $assignment->assignee->id);
        $this->assertEquals($assignee->id, $assignment->assignee_user_id);
    }


    public function testAssignerRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        /** @var User $assigner */
        $assignment = factory(Assignment::class)->create();
        $assigner   = factory(User::class)->create();

        // preconditions
        $this->assertFalse($assignment->assigner()->exists());

        // action
        $assignment->assigner()->associate($assigner);

        // postconditions
        $assignment->load('assigner');
        $this->assertTrue($assignment->assigner()->exists());
        $this->assertEquals($assigner->id, $assignment->assigner->id);
        $this->assertEquals($assigner->id, $assignment->assigner_user_id);
    }


    public function testTaskRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        /** @var Task $task */
        $assignment = factory(Assignment::class)->create();
        $task       = factory(Task::class)->create();

        // preconditions
        $this->assertNotEquals($task->id, $assignment->task_id);
        $this->assertNotEquals($task->id, $assignment->task->id);

        // action
        $assignment->task()->associate($task);

        // postconditions
        $assignment->load('task');
        $this->assertTrue($assignment->task()->exists());
        $this->assertEquals($task->id, $assignment->task->id);
        $this->assertEquals($task->id, $assignment->task_id);
    }


    public function testGetRating()
    {
        // prepare
        /** @var Assignment $assignment */
        $assignment = factory(Assignment::class)->create();

        // preconditions
        $this->assertNull($assignment->getRating());

        // action
        $assignment->comments()->create(['text' => 'blah', 'rating' => 2]);
        $assignment->comments()->create(['text' => 'blah again', 'rating' => 3]);

        // postconditions
        $assignment->load('comments');
        $this->assertEquals(2.5, $assignment->getRating());
    }
}
