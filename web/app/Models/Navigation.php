<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", 
        "path", 
        "uri", 
    ];

    public $timestamps = false;

    public function scopeNavigations($query)
    {
        return $query->whereNavigationId($this->id);
    }

    public static function cache()
    {
        if (!Cache::has("navigations"))
        {
            Cache::add("navigations", Navigation::with("sub")->get(), config("cache.keep"));
        }
    }
}
