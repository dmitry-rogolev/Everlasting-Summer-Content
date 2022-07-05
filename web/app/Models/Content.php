<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Content extends Model
{
    use HasFactory, Searchable;

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
        ];
    }
}
