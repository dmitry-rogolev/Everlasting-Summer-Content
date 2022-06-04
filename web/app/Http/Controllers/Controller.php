<?php

namespace App\Http\Controllers;

use App\Models\Lang;
use App\Models\Navigation;
use App\Models\Theme;
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

    protected string $theme;

    protected Collection $themes;

    protected Collection $inversionThemes;

    protected string $lang;

    public function __construct()
    {
        Cache::flush();
    }

    protected function settings(Request $request, string $title = null)
    {
        $this->lang($request);
        $this->theme($request);
        $this->title($title);
    }

    protected function theme(Request $request)
    {
        if ($request->has("theme") && Storage::disk("theme")->exists($request->get("theme") . ".css"))
        {
            session()->put("theme", $request->get("theme"));
        }
        $this->theme = session("theme", config("view.theme_default"));
        Theme::cache();
        $this->themes = Cache::get("themes");
        $this->inversionThemes = Cache::get("inversion_themes");
    }

    protected function lang(Request $request)
    {
        if ($request->has("lang") && Storage::disk("lang")->exists($request->get("lang")))
        {
            session()->put("lang", $request->get("lang"));
        }
        $this->lang = session("lang", config("app.locale"));
        App::setLocale(session("lang", config("app.locale")));
        Lang::cache();
    }

    protected function title(string $title = null)
    {
        $this->title = $title ? $title . " | " . config("view.title") : config("view.title");
    }
}
