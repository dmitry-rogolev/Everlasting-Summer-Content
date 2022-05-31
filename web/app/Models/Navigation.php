<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Navigation extends Model
{
    use HasFactory;

    public function scopeParents($query)
    {
        return $query->whereList(1);
    }

    public function scopeList($query, $list)
    {
        return $query->whereList($list);
    }

    public function scopeSub()
    {
        if (isset($this->sub) && !empty($this->sub))
        {
            $this->sub = $this->list($this->sub)->get()->each(function($item)
            {
                $item->sub();
            });
        }
    }

    public function scopeCache()
    {
        Cache::remember("navigation", config("cache.keep"), function()
        {
            return Navigation::parents()->get()->each(function($item)
            {
                $item->sub();
            });
        });
    }
}
