<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

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
        if ($this->folder_id)
            return $this->whereId($this->folder_id);
        else 
            return $this->user();
    }

    public function folders()
    {
        return $this->whereFolderId($this->id);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function remove()
    {
        $folders = $this->folders()->get();

        foreach ($folders as $folder)
        {
            $folder->remove();
        }

        foreach ($this->contents as $content)
        {
            $content->delete();
        }

        return $this->delete();
    }

    public function scopeVisibles($query)
    {
        return $query->whereVisibility(true);
    }
}
