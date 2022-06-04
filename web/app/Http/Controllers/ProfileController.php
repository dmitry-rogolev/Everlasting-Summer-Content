<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings($request);

        Navigation::cache();

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.profile") => route("profile"), 
        ]);

        Cache::put("breadcrumbs", $breadcrumbs);
        
        return view("profile", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => __("page.profile"), 
            "referer" => url("/"), 
        ]);
    }
}
