<?php

namespace Tests\Feature\Models;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    public function test_avatar_can_get_the_user()
    {
        $avatar = Avatar::factory()
                    ->for(User::factory())
                    ->create();

        $this->assertModelExists($avatar->user);
    }

    public function test_avatar_can_be_removed()
    {
        Avatar::truncate();
        
        $avatar = Avatar::factory()->withFile()->create();

        $this->assertTrue(Storage::disk("tmp")->exists("public/avatars/" . $avatar->user->id . "/" . $avatar->name));
        
        $this->assertTrue($avatar->remove());

        $this->assertTrue(Avatar::all()->isEmpty());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }

    public function test_avatar_can_be_force_removed()
    {
        Avatar::truncate();

        $avatar = Avatar::factory()->withFile()->create();

        $this->assertTrue(Storage::disk("tmp")->exists("public/avatars/" . $avatar->user->id . "/" . $avatar->name));

        $this->assertTrue($avatar->forceRemove());

        $this->assertTrue(Avatar::all()->isEmpty());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }
}
