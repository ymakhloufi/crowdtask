<?php

namespace Tests\Acceptance\Auth;

use Tests\TestCase;
use Yama\Assignment\Assignment;
use Yama\Attachment\Attachment;

class AttachmentTest extends TestCase
{
    public function testCommentsRelation()
    {
        // prepare
        /** @var Attachment $attachment */
        /** @var Assignment $assignment */
        $assignment = factory(Assignment::class)->create();
        $attachment = $assignment->attachments()->create(['path' => '/path/file.jpeg', 'filetype' => 'image/jpeg']);

        // preconditions
        $this->assertFalse($attachment->comments()->exists());

        // action
        $attachment->comments()->create(['text' => 'some comment']);

        // postconditions
        $attachment->load('comments');
        $this->assertEquals(1, $attachment->comments()->count());
        $this->assertEquals('some comment', $attachment->comments()->first()->text);
    }


    public function testTaskRelation()
    {
        // prepare
        /** @var Assignment $assignment */
        /** @var Attachment $attachment */
        $assignment    = factory(Assignment::class)->create();
        $newAssignment = factory(Assignment::class)->create();
        $attachment    = $assignment->attachments()->create(['path' => '/path/file.jpeg', 'filetype' => 'image/jpeg']);

        // preconditions
        $this->assertNotEquals($newAssignment->id, $attachment->attachable_id);
        $this->assertNotEquals($newAssignment->id, $attachment->attachable->id);

        // action
        $attachment->attachable()->associate($newAssignment);

        // postconditions
        $attachment->load('attachable');
        $this->assertTrue($attachment->attachable()->exists());
        $this->assertEquals($newAssignment->id, $attachment->attachable->id);
        $this->assertEquals($newAssignment->id, $attachment->attachable_id);
    }
}
