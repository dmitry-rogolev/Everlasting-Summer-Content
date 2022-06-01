<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Navigation extends Model
{
    use HasFactory;

    public function sub()
    {
        return $this->hasMany(SubNavigation::class);
    }

    public function scopeCache()
    {
        Cache::remember("navigation", config("cache.keep"), function()
        {
            return Navigation::with("sub")->get();
        });
    }
}
