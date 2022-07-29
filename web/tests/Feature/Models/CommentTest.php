<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_comment_can_get_the_user()
    {
        $comment = Comment::factory()->for(User::factory())->create();

        $this->assertModelExists($comment->user);
    }

    public function test_comment_can_get_the_content()
    {
        $comment = Comment::factory()->for(Content::factory())->create();

        $this->assertModelExists($comment->content);
    }

    public function test_comment_can_get_likes()
    {
        $comment = Comment::factory()->hasLikes(3)->create();

        $this->assertTrue($comment->likes->isNotEmpty());
    }

    public function test_comment_can_get_dislikes()
    {
        $comment = Comment::factory()->hasDislikes(3)->create();

        $this->assertTrue($comment->dislikes->isNotEmpty());
    }

    public function test_comment_can_get_parent_comment()
    {
        $parent = Comment::factory()->create();

        $comment = Comment::factory()->create([
            "comment_id" => $parent->id, 
        ]);

        $this->assertModelExists($comment->comment()->first());
    }

    public function test_comment_can_get_comments()
    {
        $comment = Comment::factory()->create();

        Comment::factory()->count(3)->create([
            "comment_id" => $comment->id, 
        ]);

        $this->assertTrue($comment->comments()->get()->isNotEmpty());
    }

    public function test_comment_can_be_removed()
    {
        Like::truncate();
        Dislike::truncate();

        $comment = Comment::factory()
                        ->hasLikes(3)
                        ->hasDislikes(3)
                        ->create();

        Comment::factory()->count(3)->create([
            "comment_id" => $comment->id, 
        ]);

        $this->assertTrue($comment->remove());

        $this->assertTrue(Like::all()->isEmpty());
        $this->assertTrue(Dislike::all()->isEmpty());
    }

    public function test_comment_can_be_force_removed()
    {
        Like::truncate();
        Dislike::truncate();
        
        $comment = Comment::factory()
                        ->hasLikes(3)
                        ->hasDislikes(3)
                        ->create();

        Comment::factory()->count(3)->create([
            "comment_id" => $comment->id, 
        ]);

        $this->assertTrue($comment->forceRemove());

        $this->assertTrue(Like::all()->isEmpty());
        $this->assertTrue(Dislike::all()->isEmpty());
    }
}
