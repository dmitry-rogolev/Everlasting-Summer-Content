<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", 
        "inversion_id", 
    ];

    public $timestamps = false;

    public function inversion()
    {
        return $this->whereId($this->inversion_id);
    }

    public function cacheInversions()
    {
        if (!Cache::has("inversion_themes"))
        {
            $inversions = new Collection();

            foreach ($this->all() as $theme)
            {
                $inversions->put($theme->name, $theme->inversion()->first()->name);
            }
            
            Cache::add("inversion_themes", $inversions, config("cache.keep"));
        }
    }
}
