<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    public function test_like_can_get_user()
    {
        $like = Like::factory()->for(User::factory())->create();

        $this->assertModelExists($like->user);
    }

    public function test_like_can_get_content()
    {
        $like = Like::factory()->for(Content::factory())->create();

        $this->assertModelExists($like->content);
    }

    public function test_like_can_get_comment()
    {
        $like = Like::factory()->for(Comment::factory())->create();

        $this->assertModelExists($like->comment);
    }
}
