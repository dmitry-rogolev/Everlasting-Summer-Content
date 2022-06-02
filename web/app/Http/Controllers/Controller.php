<?php

namespace App\Http\Controllers;

use App\Models\Theme;
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

    public function __construct(?string $title = null)
    {
        $this->title = $title ?? config("view.title");
        
        Cache::flush();
        Theme::cache();

        $this->themes = Cache::get("themes");
        $this->inversionThemes = Cache::get("inversion_themes");
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
