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

    public function __construct(?string $title = null)
    {
        $this->title = $title ?? config("view.title");
        $this->theme = session("theme", config("view.theme_default"));

        Cache::flush();
        Theme::cache();
    }

    protected function theme(Request $request)
    {
        if ($request->has("theme") && Storage::disk("theme")->exists($request->get("theme") . ".css"))
        {
            session()->put("theme", $request->get("theme"));
        }
        $this->theme = session("theme");
    }
}
