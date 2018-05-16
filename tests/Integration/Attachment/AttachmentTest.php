<?php

namespace Tests\Integration\Attachment;

use Tests\TestCase;
use Yama\Assignment\Assignment;
use Yama\Attachment\Attachment;
use Yama\Comment\Comment;
use Yama\Task\Task;

class AttachmentTest extends TestCase
{
    public function testCommentsRelation()
    {
        // prepare
        /** @var Attachment $attachment */
        $attachment = factory(Attachment::class)->create();

        // preconditions
        $this->assertFalse($attachment->comments()->exists());

        // action
        $attachment->comments()->create(['text' => 'some comment']);

        // postconditions
        $attachment->load('comments');
        $this->assertEquals(1, $attachment->comments()->count());
        $this->assertEquals('some comment', $attachment->comments()->first()->text);
    }


    public function testAttachableRelation()
    {
        // prepare
        /** @var Attachment $attachment */
        $attachable = factory($this->faker->randomElement([Assignment::class, Task::class, Comment::class]))->create();
        $attachment = factory(Attachment::class)->create();

        // preconditions
        $this->assertNotEquals($attachable->id, $attachment->attachable_id);
        $this->assertNotEquals($attachable->id, $attachment->attachable->id);

        // action
        $attachment->attachable()->associate($attachable);

        // postconditions
        $attachment->load('attachable');
        $this->assertTrue($attachment->attachable()->exists());
        $this->assertEquals($attachable->id, $attachment->attachable->id);
        $this->assertEquals($attachable->id, $attachment->attachable_id);
    }
}
