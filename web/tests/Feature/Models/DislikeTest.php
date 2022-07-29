<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Dislike;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DislikeTest extends TestCase
{
    public function test_dislike_can_get_user()
    {
        $dislike = Dislike::factory()->for(User::factory())->create();

        $this->assertModelExists($dislike->user);
    }

    public function test_dislike_can_get_content()
    {
        $dislike = Dislike::factory()->for(Content::factory())->create();

        $this->assertModelExists($dislike->content);
    }

    public function test_dislike_can_get_comment()
    {
        $dislike = Dislike::factory()->for(Comment::factory())->create();

        $this->assertModelExists($dislike->comment);
    }
}
