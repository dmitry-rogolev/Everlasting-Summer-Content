<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", 
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

    public function remove()
    {
        $folders = $this->folders()->get();

        foreach ($folders as $folder)
        {
            $folder->remove();
        }

        $this->contents()->delete();

        return $this->delete();
    }
}
