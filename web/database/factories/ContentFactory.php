<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    protected $model = Content::class;

    protected ?User $user = null;

    protected ?File $file = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->file ? $this->file->getClientOriginalName() : "content.png", 
            "title" => $this->file ? Str::of($this->file->getClientOriginalName())->beforeLast(".") : "content", 
            "extension" => $this->file ? $this->file->extension() : ".png", 
            "type" => $this->file ? $this->file->getMimeType() : "image/png", 
            "path" => "", 
            "tags" => $this->file ? Str::of($this->file->getClientOriginalName())->beforeLast(".") : "content", 
            "visibility" => true, 
            "user_id" => $this->user ? $this->user->id : null, 
        ];
    }

    public function withFile() : self
    {
        $this->user = User::factory()->create();

        $this->file = UploadedFile::fake()->image("content.png");

        $this->file->storeAs("tmp/public/contents/" . $this->user->id, $this->file->getClientOriginalName());

        return $this;
    }
}
