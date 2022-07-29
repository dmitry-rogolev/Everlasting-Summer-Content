<?php

namespace Tests\Feature\Models;

use App\Models\Content;
use App\Models\Download;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    public function test_favorite_can_get_user()
    {
        $favorite = Favorite::factory()->for(User::factory())->create();

        $this->assertModelExists($favorite->user);
    }

    public function test_favorite_can_get_content()
    {
        $favorite = Favorite::factory()->for(Content::factory())->create();

        $this->assertModelExists($favorite->content);
    }
}
