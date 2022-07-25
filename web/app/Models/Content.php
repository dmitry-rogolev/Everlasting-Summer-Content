<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $fillable = [
        "name", 
        "title", 
        "extension", 
        "type", 
        "path", 
        "visibility",
        "tags",  
        "folder_id", 
        "user_id", 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function scopeVisibles($query)
    {
        return $query->whereVisibility(true);
    }

    public function toSearchableArray()
    {
        return [
            "tags" => $this->tags, 
            "path" => $this->path, 
            "description" => $this->description, 
        ];
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function remove() : ?bool
    {
        $path = $this->path;

        $path = $path ? $path . "/" : "";

        Storage::disk("local")
            ->move("public/contents/" . $this->user_id . "/" . $path . $this->name, 
                   "deletes/contents/" . $this->user_id . "/" . $path . $this->name);

        $this->likes()->delete();
        $this->dislikes()->delete();
        $this->views()->delete();
        $this->downloads()->delete();
        $this->favorites()->delete();

        foreach ($this->comments as $comment)
        {
            $comment->remove();
        }

        return $this->delete();
    }

    public function forceRemove() : ?bool
    {
        $path = $this->path;

        $path = $path ? $path . "/" : "";

        Storage::disk("local")
            ->delete("deletes/contents/" . $this->user_id . "/" . $path . $this->name);

        $this->likes()->forceDelete();
        $this->dislikes()->forceDelete();
        $this->views()->forceDelete();
        $this->downloads()->forceDelete();
        $this->favorites()->forceDelete();
        
        foreach ($this->comments as $comment)
        {
            $comment->forceRemove();
        }

        return $this->forceDelete();
    }
}
