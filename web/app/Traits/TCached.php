<?php 

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait TCached 
{
    protected function cached() : void
    {
        $this->cacheThemes();
        $this->cacheInversionThemes();
        $this->cacheLangs();
    }

    private function cacheThemes()
    {
        if (Cache::has("themes")) return;

        $themes = new Collection();

        foreach (config("theme.themes") as $theme)
        {
            $themes->put(__("theme." . $theme), $theme);
        }

        Cache::add("themes", $themes, config("cache.keep"));
    }

    private function cacheInversionThemes()
    {
        if (Cache::has("inversion_themes")) return;

        $inversions = new Collection(config("theme.inversion_themes"));

        Cache::add("inversion_themes", $inversions, config("cache.keep"));
    }
    
    private function cacheLangs()
    {
        if (Cache::has("langs")) return;
        
        $langs = new Collection();

        foreach (config("lang.langs") as $lang)
        {
            $langs->put(__("lang." . $lang), $lang);
        }

        Cache::add("langs", $langs, config("cache.keep"));
    }
}
