<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $title;

    protected string $theme;

    protected Collection $themes;

    protected Collection $inversionThemes;

    public function __construct(?string $title = null, ?string $theme = null)
    {
        $this->title = $title ?? "";
        
        if (Storage::disk("theme")->exists($theme . ".css"))
        {
            session()->put("theme", $theme);
        }
        $this->theme = session("theme", config("view.theme_default"));
        $this->themes = config("view.themes");
        $this->inversionThemes = config("view.inversion_themes");

        Cache::put("themes", $this->themes);
        Cache::put("inversion_themes", $this->inversionThemes);
    }

    protected function theme(Request $request)
    {
        if ($request->has("theme") && Storage::disk("theme")->exists($request->get("theme") . ".css"))
        {
            session()->put("theme", $request->get("theme"));
        }
        $this->theme = session("theme", config("view.theme_default"));
    }
}
