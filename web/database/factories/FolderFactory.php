<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Folder>
 */
class FolderFactory extends Factory
{
    protected $model = Folder::class;

    protected ?User $user = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => "folder", 
            "path" => "folder", 
            "visibility" => true, 
            "user_id" => $this->user ? $this->user->id : null, 
        ];
    }

    public function withDirectory() : self
    {
        $this->user = User::factory()->create();

        Storage::disk("tmp")->makeDirectory("public/contents/" . $this->user->id . "/folder");

        return $this;
    }
}
