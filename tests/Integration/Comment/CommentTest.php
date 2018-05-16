<?php

namespace Tests\Integration\Comment;

use Tests\TestCase;
use Yama\Assignment\Assignment;
use Yama\Comment\Comment;
use Yama\Task\Task;
use Yama\User\User;

class CommentTest extends TestCase
{
    public function testAttachmentsRelation()
    {
        // prepare
        /** @var Comment $comment */
        $comment = factory(Comment::class)->create();

        // preconditions
        $this->assertFalse($comment->attachments()->exists());

        // action
        $comment->attachments()->create(['path' => '/somewhere/file.jpeg', 'filetype' => 'image/jpeg']);

        // postconditions
        $comment->load('attachments');
        $this->assertEquals(1, $comment->attachments()->count());
        $this->assertEquals('/somewhere/file.jpeg', $comment->attachments()->first()->path);
        $this->assertEquals('image/jpeg', $comment->attachments()->first()->filetype);
    }


    public function testRepliesRelation()
    {
        // prepate
        /** @var Comment $comment */
        $comment = factory(Comment::class)->create();

        // preconditions
        $this->assertFalse($comment->replies()->exists());

        // action
        $comment->replies()->create(['text' => 'some reply']);

        // postcondition
        $this->assertEquals(1, $comment->replies()->count());
        $this->assertEquals('some reply', $comment->replies()->first()->text);
    }


    public function testUserRelation()
    {
        // prepare
        /** @var comment $comment */
        /** @var User $user */
        $comment = factory(Comment::class)->create();
        $user    = factory(User::class)->create();

        // preconditions
        $this->assertNotEquals($user->id, $comment->user_id);
        $this->assertNotEquals($user->id, $comment->user->id);

        // action
        $comment->user()->associate($user);

        // postconditions
        $comment->load('user');
        $this->assertTrue($comment->user()->exists());
        $this->assertEquals($user->id, $comment->user->id);
        $this->assertEquals($user->id, $comment->user_id);
    }


    public function testCommentableRelation()
    {
        // prepare
        /** @var Comment $comment */
        $commentable = factory($this->faker->randomElement([Assignment::class, Task::class, Comment::class]))->create();
        $comment     = factory(Comment::class)->create();

        // preconditions
        $this->assertNotEquals($commentable->id, $comment->commentable_id);
        $this->assertNotEquals($commentable->id, $comment->commentable->id);

        // action
        $comment->commentable()->associate($commentable);

        // postconditions
        $comment->load('commentable');
        $this->assertTrue($comment->commentable()->exists());
        $this->assertEquals($commentable->id, $comment->commentable->id);
        $this->assertEquals($commentable->id, $comment->commentable_id);
    }

}
