<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Dislike;
use App\Models\Download;
use App\Models\Favorite;
use App\Models\Folder;
use App\Models\Like;
use App\Models\User;
use App\Models\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContentTest extends TestCase
{
    public function test_content_can_get_the_user()
    {
        $content = Content::factory()->for(User::factory())->create();

        $this->assertModelExists($content->user);
    }

    public function test_content_can_get_the_folder()
    {
        $content = Content::factory()->for(Folder::factory())->create();

        $this->assertModelExists($content->folder);
    }

    public function test_can_get_visible_content()
    {
        Content::truncate();

        Content::factory()->count(3)->create([
            "visibility" => true, 
        ]);

        Content::factory()->count(2)->create([
            "visibility" => false, 
        ]);

        $this->assertSame(3, Content::visibles()->count());

        $this->assertSame(2, Content::notVisibles()->count());
    }

    public function test_content_can_get_likes()
    {
        $content = Content::factory()->hasLikes(3)->create();

        $this->assertTrue($content->likes->isNotEmpty());
    }

    public function test_content_can_get_dislikes()
    {
        $content = Content::factory()->hasDislikes(3)->create();

        $this->assertTrue($content->dislikes->isNotEmpty());
    }

    public function test_content_can_get_views()
    {
        $content = Content::factory()->hasViews(3)->create();

        $this->assertTrue($content->views->isNotEmpty());
    }

    public function test_content_can_get_downloads()
    {
        $content = Content::factory()->hasDownloads(3)->create();

        $this->assertTrue($content->downloads->isNotEmpty());
    }

    public function test_content_can_get_favorites()
    {
        $content = Content::factory()->hasFavorites(3)->create();

        $this->assertTrue($content->favorites->isNotEmpty());
    }

    public function test_content_can_get_comments()
    {
        $content = Content::factory()->hasComments(3)->create();

        $this->assertTrue($content->comments->isNotEmpty());
    }

    public function test_content_can_be_removed()
    {
        Like::truncate();
        Dislike::truncate();
        View::truncate();
        Download::truncate();
        Favorite::truncate();
        Comment::truncate();
        
        $content = Content::factory()
                        ->withFile()
                        ->hasLikes(3)
                        ->hasDislikes(3)
                        ->hasViews(3)
                        ->hasDownloads(3)
                        ->hasFavorites(3)
                        ->hasComments(3)
                        ->create();

        $this->assertTrue($content->remove());

        $this->assertTrue(Like::all()->isEmpty());
        $this->assertTrue(Dislike::all()->isEmpty());
        $this->assertTrue(View::all()->isEmpty());
        $this->assertTrue(Download::all()->isEmpty());
        $this->assertTrue(Favorite::all()->isEmpty());
        $this->assertTrue(Comment::all()->isEmpty());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }

    public function test_content_can_be_force_removed()
    {
        Like::truncate();
        Dislike::truncate();
        View::truncate();
        Download::truncate();
        Favorite::truncate();
        Comment::truncate();

        $content = Content::factory()
                        ->withFile()
                        ->hasLikes(3)
                        ->hasDislikes(3)
                        ->hasViews(3)
                        ->hasDownloads(3)
                        ->hasFavorites(3)
                        ->hasComments(3)
                        ->create();

        $this->assertTrue($content->forceRemove());

        $this->assertTrue(Like::all()->isEmpty());
        $this->assertTrue(Dislike::all()->isEmpty());
        $this->assertTrue(View::all()->isEmpty());
        $this->assertTrue(Download::all()->isEmpty());
        $this->assertTrue(Favorite::all()->isEmpty());
        $this->assertTrue(Comment::all()->isEmpty());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }
}
