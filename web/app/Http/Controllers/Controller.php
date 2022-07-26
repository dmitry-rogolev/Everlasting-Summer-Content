<?php

namespace App\Http\Controllers;

use App\Traits\TCached;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, TCached;

    protected string $title;

    protected ?string $keywords = null;

    protected ?string $description = null;

    protected ?string $lang = null;

    protected ?string $theme = null;

    protected ?Collection $inversionThemes = null;

    protected ?Collection $data = null;

    protected ?Collection $breadcrumbs = null;

    protected bool $can = false;

    public function __construct()
    {
        cache()->flush();
    }

    protected function settings(
        string $title = null, 
        string $description = null, 
        string $keywords = null, 
        string $lang = null, 
        string $theme = null, 
    ) : void
    {
        $this->setValues($title, $description, $keywords);
        
        $this->lang = $this->lang($lang);
        $this->theme = $this->theme($theme);

        $this->cached();

        $this->inversionThemes = cache("inversion_themes");

        $this->data = $this->data();
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

    protected function data() : Collection
    {
        return new Collection([
            "theme" => $this->theme, 
            "inversion_themes" => cache("inversion_themes"), 
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
        if ($requestOrTheme instanceof Request && $requestOrTheme->has("theme") && Storage::disk("theme")->exists($requestOrTheme->get("theme") . config("view.css_extension")))
            session()->put("theme", $requestOrTheme->get("theme"));
        
        else if (is_string($requestOrTheme) && Storage::disk("theme")->exists($requestOrTheme . config("view.css_extension")))
            session()->put("theme", $requestOrTheme);

        else if (request()->has("theme") && Storage::disk("theme")->exists(request()->get("theme") . config("view.css_extension")))
            session()->put("theme", request()->get("theme"));
        
        else if (!session()->has("theme"))
            session()->put("theme", config("theme.default"));
        
        return session("theme");
    }

    protected function setBreadcrumbs(Collection $breadcrumbs) : void
    {
        $this->breadcrumbs = $breadcrumbs;

        if ($this->data)
            $this->data->put("breadcrumbs", $breadcrumbs);
        else 
            $this->data = $this->data();
    }

    protected function breadcrumbs(Collection|array $breadcrumbs) : Collection
    {
        $crumbs = new Collection();

        foreach ($breadcrumbs as $name => $url)
        {
            $crumbs->push(new Collection([
                "name" => $name, 
                "url" => $url, 
                $name, 
                $url, 
            ]));
        }

        return $crumbs;
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

    private function setValues(
        string $title = null, 
        string $description = null, 
        string $keywords = null, 
        string $lang = null, 
        string $theme = null, 
    ) : void
    {
        $this->title = $this->title($title);
        $this->description = $this->description($description);
        $this->keywords = $this->keywords($keywords);

        if ($lang)
            $this->lang = $lang;
        
        if ($theme)
            $this->theme = $theme;
    }
}
