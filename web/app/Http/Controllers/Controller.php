<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Theme;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $title;

    protected ?string $keywords = null;

    protected ?string $description = null;

    protected ?string $lang = null;

    protected ?string $theme = null;

    protected ?Collection $langs = null;

    protected ?Collection $themes = null;

    protected ?Collection $inversionThemes = null;

    protected ?Collection $data = null;

    protected ?Collection $breadcrumbs = null;

    protected bool $can = false;

    public function __construct(
        string $title = null, 
        string $description = null, 
        string $keywords = null, 
        string $lang = null, 
        string $theme = null, 
        Collection $data = null, 
        Collection $breadcrumbs = null, 
    )
    {
        $this->setValues($title, $description, $keywords, $lang, $theme, $data, $breadcrumbs);

        $this->cached();
    }

    protected function settings(
        string $title = null, 
        string $description = null, 
        string $keywords = null, 
        string $lang = null, 
        string $theme = null, 
        Collection $data = null, 
        Collection $breadcrumbs = null, 
    ) : void
    {
        $this->setValues($title, $description, $keywords, null, null, null, $breadcrumbs);
        
        $this->lang = $this->lang($this->lang ?: $lang);
        $this->theme = $this->theme($this->theme ?: $theme);
        $this->langs = $this->langs();
        $this->themes = $this->themes();
        $this->inversionThemes = $this->inversionThemes();

        $this->data = $this->data($this->data ?: $data);
    }

    protected function title(string $title = null) : string
    {
        return $title ? $title . " | " . config("view.title") : config("view.title");
    }

    protected function description(string $description = null) : string
    {
        return $description ?: config("view.description");
    }

    protected function keywords(string $keywords = null) : string
    {
        return $keywords ?: config("view.keywords");
    }

    protected function data(Collection $data = null) : Collection
    {
        return $data ?: new Collection([
            "theme" => $this->theme, 
            "langs" => $this->langs, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "description" => $this->description, 
            "keywords" => $this->keywords, 
            "lang" => $this->lang, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }

    protected function lang(Request|string $requestOrLang = null) : string
    {
        if ($requestOrLang instanceof Request && $requestOrLang->has("lang") && Storage::disk("lang")->exists($requestOrLang->get("lang")))
            session()->put("lang", $requestOrLang->get("lang"));
        
        else if (is_string($requestOrLang) && Storage::disk("lang")->exists($requestOrLang))
            session()->put("lang", $requestOrLang);

        else if (request()->has("lang") && Storage::disk("lang")->exists(request()->get("lang")))
            session()->put("lang", request()->get("lang"));

        $lang = session("lang", config("app.locale"));

        App::setLocale($lang);

        return $lang;
    }

    protected function theme(Request|string $requestOrTheme = null) : string
    {
        if ($requestOrTheme instanceof Request && $requestOrTheme->has("theme") && Storage::disk("theme")->exists($requestOrTheme->get("theme") . ".css"))
            session()->put("theme", $requestOrTheme->get("theme"));
        
        else if (is_string($requestOrTheme) && Storage::disk("theme")->exists($requestOrTheme . ".css"))
            session()->put("theme", $requestOrTheme);

        else if (request()->has("theme") && Storage::disk("theme")->exists(request()->get("theme") . ".css"))
            session()->put("theme", request()->get("theme"));
        
        else 
            session()->put("theme", config("theme.default"));

        return session("theme");
    }

    protected function setBreadcrumbs(Collection $breadcrumbs) : void
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->data = $this->data($this->data);
    }

    protected function can($ability, $arguments = []) : bool
    {
        try {
            $this->authorize($ability, $arguments);
            return true;
        } catch (AuthorizationException $e) {
            return false;
        }
    }

    private function cached() : void
    {
        $cached = config("cache.cached");

        foreach ($cached as $class)
        {
            if (is_string($class) && class_exists($class))
            {
                $class = new $class();

                if ($class instanceof Model)
                {
                    Cache::add($class->getTable(), $class::all(), config("cache.keep"));
                }
            }
        }
    }

    private function setValues(
        string $title = null, 
        string $description = null, 
        string $keywords = null, 
        string $lang = null, 
        string $theme = null, 
        Collection $data = null, 
        Collection $breadcrumbs = null, 
    ) : void
    {
        $this->title = $this->title($title);
        $this->description = $this->description($description);
        $this->keywords = $this->keywords($keywords);

        if ($lang)
            $this->lang = $lang;
        
        if ($theme)
            $this->theme = $theme;

        if ($data)
            $this->data = $data;

        if ($breadcrumbs)
            $this->breadcrumbs = $breadcrumbs;
    }

    private function langs() : Collection
    {
        return $this->getLocaleCollection("langs", Lang::class, function($lang)
        {
            return [ __("lang." . $lang->name), $lang->name ];
        });
    }

    private function themes() : Collection
    {
        return $this->getLocaleCollection("themes", Theme::class, function($theme)
        {
            return [ __("theme." . $theme->name), $theme->name ];
        });
    }

    private function inversionThemes() : Collection
    {
        return $this->getLocaleCollection("inversion_themes", Theme::class, function($theme)
        {
            return [ $theme->name, $theme->inversion()->first()->name ];
        });
    }

    private function getLocaleCollection(string $tableName, string $modelName, callable $callback) : Collection
    {
        if (!Cache::has($tableName))
            $this->cached();

        $collection = new Collection();

        foreach (Cache::get($tableName) ?? $modelName::all() as $model)
        {
            $collection->put(...$callback($model));
        }

        Cache::add($tableName, $collection, config("cache.keep"));

        return $collection;
    }
}
