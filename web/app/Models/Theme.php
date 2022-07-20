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

    public static function cache()
    {
        if (!Cache::has("themes"))
        {
            $themes = new Collection();
            foreach (Theme::all() as $theme)
            {
                $themes->put(__("theme." . $theme->name), $theme->name);
            }
            Cache::add("themes", $themes, config("cache.keep"));
        }

        if (!Cache::has("inversion_themes"))
        {
            $all = Theme::all();
            $inversion_themes = new Collection();
            foreach ($all as $theme)
            {
                $inversion_themes->put($theme->name, $all->where("id", $theme->inversion_id)->values()->get(0)->name);
            }
            Cache::add("inversion_themes", $inversion_themes, config("cache.keep"));
        }
    }
}
