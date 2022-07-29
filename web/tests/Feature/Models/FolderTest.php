<?php

namespace Tests\Feature\Models;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FolderTest extends TestCase
{
    public function test_folder_can_get_user()
    {
        $folder = Folder::factory()->for(User::factory())->create();

        $this->assertModelExists($folder->user);
    }

    public function test_folder_can_get_parent_folder()
    {
        $parent = Folder::factory()->create();

        $folder = Folder::factory()->create([
            "folder_id" => $parent->id, 
        ]);

        $this->assertModelExists($folder->folder()->first());
    }

    public function test_folder_can_get_folders()
    {
        $folder = Folder::factory()->create();

        Folder::factory()->count(3)->create([
            "folder_id" => $folder->id, 
        ]);

        $this->assertTrue($folder->folders()->get()->isNotEmpty());
    }

    public function test_folder_can_get_contents()
    {
        $folder = Folder::factory()->hasContents(3)->create();

        $this->assertTrue($folder->contents->isNotEmpty());
    }

    public function test_can_get_visible_folders()
    {
        Folder::truncate();
        
        Folder::factory()->count(3)->create([
            "visibility" => true, 
        ]);

        Folder::factory()->count(2)->create([
            "visibility" => false, 
        ]);

        $this->assertSame(3, Folder::visibles()->count());

        $this->assertSame(2, Folder::notVisibles()->count());
    }

    public function test_folder_can_be_removed()
    {
        Folder::truncate();

        $folder = Folder::factory()->withDirectory()->create();

        Folder::factory()->count(3)->create([
            "folder_id" => $folder->id, 
        ]);

        $this->assertTrue($folder->remove());

        $this->assertSame(1, Folder::all()->count());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }

    public function test_folder_can_be_force_removed()
    {
        Folder::truncate();

        $folder = Folder::factory()->withDirectory()->create();

        Folder::factory()->count(3)->for($folder->user)->create([
            "folder_id" => $folder->id, 
        ]);

        $this->assertTrue($folder->forceRemove());

        $this->assertTrue(Folder::all()->isEmpty());

        Storage::disk("tmp")->deleteDirectory("deletes");

        Storage::disk("tmp")->deleteDirectory("public");
    }
}
