<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings();

        return view('profile.delete', $this->data->merge([

            "header" => config("app.name"), 

        ])
        ->all()
        );
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
