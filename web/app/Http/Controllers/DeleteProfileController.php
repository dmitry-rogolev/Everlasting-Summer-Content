<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings();

        return view('profile.delete', 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => config("app.name"), 
        ]);
    }

    public function destroy(Request $request)
    {
        $theme = session("theme", config("theme.default"));
        $lang = session("lang", config("app.locale"));

        $request->user()->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->put("theme", $theme);
        session()->put("lang", $lang);

        return redirect('/');
    }
}
