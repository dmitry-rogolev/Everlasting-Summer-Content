<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Theme extends Model
{
    use HasFactory;

    public static function cache()
    {
        if (!Cache::has("themes"))
        {
            $themes = new Collection();
            foreach (Theme::all() as $theme)
            {
                $themes->put($theme->name, $theme->theme);
            }
            Cache::add("themes", $themes, config("cache.keep"));
        }

        if (!Cache::has("inversion_themes"))
        {
            $all = Theme::all();
            $inversion_themes = new Collection();
            foreach ($all as $theme)
            {
                $inversion_themes->put($theme->theme, $all->where("id", $theme->inversion)->values()->get(0)->theme);
            }
            Cache::add("inversion_themes", $inversion_themes, config("cache.keep"));
        }
    }
}
