<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings($request);

        Navigation::cache();

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.profile.header") => route("profile"), 
        ]);

        Cache::put("breadcrumbs", $breadcrumbs);
        
        return view("profile", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => __("page.profile.header"), 
            "referer" => url("/"), 
            "avatar" => new Collection([
                "id" => Str::random(10), 
                "labelledby" => Str::random(10), 
                "header" => __("page.profile.avatar.header"), 
            ]), 
        ]);
    }
}
