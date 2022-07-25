<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Folder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title", 
        "path", 
        "visibility", 
        "folder_id", 
        "user_id", 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->whereId($this->folder_id);
    }

    public function folders()
    {
        return $this->whereFolderId($this->id);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function scopeVisibles($query)
    {
        return $query->whereVisibility(true);
    }

    public function remove() : ?bool
    {
        $path = $this->path;
        
        Storage::disk("local")
            ->move("public/contents/" . $this->user_id . "/" . $path, 
                   "deletes/contents/" . $this->user_id . "/" . $path);

        $folders = $this->folders()->get();

        foreach ($folders as $folder)
        {
            $folder->remove();
        }

        foreach ($this->contents as $content)
        {
            $content->remove();
        }

        return policy($this)->removeRootFolder($this->user, $this) ? $this->delete() : true;
    }

    public function forceRemove() : ?bool
    {
        $path = $this->path;

        Storage::disk("local")
            ->delete("deletes/contents/" . $this->user_id . "/" . $path);

        $folders = $this->folders()->onlyTrashed()->get();

        foreach ($folders as $folder)
        {
            $folder->forceRemove();
        }

        foreach ($this->contents as $content)
        {
            $content->forceRemove();
        }

        return policy($this)->removeRootFolder($this->user, $this) ? $this->forceDelete() : true;
    }
}
