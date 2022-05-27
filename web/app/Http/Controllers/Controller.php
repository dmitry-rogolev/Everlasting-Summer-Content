<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $title;

    protected string $theme;

    public function __construct(?string $title = null, ?string $theme = null)
    {
        parent::__construct();

        $this->title = $title ?? "";
        
        if (Storage::exists("../../public/css/theme/" . $theme . ".css"))
        {
            session()->put("theme", $theme);
        }
        $this->theme = session("theme", config("view.theme_default"));
    }

    protected function theme(Request $request)
    {
        if ($request->has("theme") && Storage::exists("../../public/css/theme/" . $request->get("theme") . ".css"))
        {
            session()->put("theme", $request->get("theme"));
        }
        $this->theme = session("theme", config("view.theme_default"));
    }
}
