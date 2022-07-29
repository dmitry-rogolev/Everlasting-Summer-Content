<?php

namespace Tests\Feature\Models;

use App\Models\Avatar;
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
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_can_get_avatar()
    {
        $user = User::factory()->hasAvatar(1)->create();

        $this->assertModelExists($user->avatar);
    }

    public function test_user_can_get_folder()
    {
        Folder::truncate();

        $user = User::factory()->hasFolders(1)->create();

        $this->assertModelExists($user->folder()->first());
    }

    public function test_user_can_get_folders()
    {
        $user = User::factory()->hasFolders(3)->create();

        $this->assertTrue($user->folders->isNotEmpty());
    }

    public function test_user_can_get_contents()
    {
        $user = User::factory()->hasContents(3)->create();

        $this->assertTrue($user->contents->isNotEmpty());
    }

    public function test_user_can_get_downloads()
    {
        $user = User::factory()->hasDownloads(3)->create();

        $this->assertTrue($user->downloads->isNotEmpty());
    }

    public function test_user_can_get_comments()
    {
        $user = User::factory()->hasComments(3)->create();

        $this->assertTrue($user->comments->isNotEmpty());
    }

    public function test_user_can_get_likes()
    {
        $user = User::factory()->hasLikes(3)->create();

        $this->assertTrue($user->likes->isNotEmpty());
    }

    public function test_user_can_get_dislikes()
    {
        $user = User::factory()->hasDislikes(3)->create();

        $this->assertTrue($user->dislikes->isNotEmpty());
    }

    public function test_user_can_get_views()
    {
        $user = User::factory()->hasViews(3)->create();

        $this->assertTrue($user->views->isNotEmpty());
    }

    public function test_user_can_get_favorites()
    {
        $user = User::factory()->hasFavorites(3)->create();

        $this->assertTrue($user->favorites->isNotEmpty());
    }

    public function test_user_can_be_removed()
    {
        Avatar::truncate();
        Folder::truncate();
        Content::truncate();
        Download::truncate();
        Comment::truncate();
        Like::truncate();
        Dislike::truncate();
        View::truncate();
        Favorite::truncate();

        $user = User::factory()
                    ->hasAvatar(1)
                    ->hasDownloads(3)
                    ->hasComments(3)
                    ->hasLikes(3)
                    ->hasDislikes(3)
                    ->hasViews(3)
                    ->hasFavorites(3)
                    ->create();

        $folder = Folder::factory()->for($user)->create();
        
        Folder::factory()->count(3)->for($user)->create([
            "folder_id" => $folder->id, 
        ]);

        Content::factory()->count(3)->for($user)->for($folder)->create();

        $this->assertTrue($user->remove());

        $this->assertSame(1, Folder::all()->count());

        $this->assertTrue(Avatar::all()->isEmpty());
        $this->assertTrue(Content::all()->isEmpty());
        $this->assertTrue(Favorite::all()->isEmpty());
    }

    public function test_user_can_be_force_removed()
    {
        Avatar::truncate();
        Folder::truncate();
        Content::truncate();
        Download::truncate();
        Comment::truncate();
        Like::truncate();
        Dislike::truncate();
        View::truncate();
        Favorite::truncate();

        $user = User::factory()
                    ->hasAvatar(1)
                    ->hasDownloads(3)
                    ->hasComments(3)
                    ->hasLikes(3)
                    ->hasDislikes(3)
                    ->hasViews(3)
                    ->hasFavorites(3)
                    ->create();

        $folder = Folder::factory()->for($user)->create();
        
        Folder::factory()->count(3)->for($user)->create([
            "folder_id" => $folder->id, 
        ]);

        Content::factory()->count(3)->for($user)->for($folder)->create();

        $this->assertTrue($user->forceRemove());

        $this->assertTrue(Avatar::all()->isEmpty());
        $this->assertTrue(Folder::all()->isEmpty());
        $this->assertTrue(Content::all()->isEmpty());
        $this->assertTrue(Favorite::all()->isEmpty());
    }
}
