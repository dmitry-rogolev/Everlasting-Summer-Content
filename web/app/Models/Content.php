<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, Searchable, SoftDeletes
    {
        SoftDeletes::forceDelete as parentForceDelete;
    }

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

    public function delete()
    {
        $this->likes()->delete();
        $this->dislikes()->delete();
        $this->views()->delete();
        $this->downloads()->delete();
        $this->favorites()->delete();

        return $this->delete();
    }

    public function forceDelete()
    {
        $this->likes()->forceDelete();
        $this->dislikes()->forceDelete();
        $this->views()->forceDelete();
        $this->downloads()->forceDelete();
        $this->favorites()->forceDelete();

        return $this->parentForceDelete();
    }
}
