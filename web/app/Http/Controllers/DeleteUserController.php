<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function show(Request $request, User $user)
    {
        $this->settings();

        return view('user.delete', $this->data->merge([

            "header" => config("app.name"), 
            "user" => $user, 

        ])
        ->all()
        );
    }

    public function destroy(Request $request)
    {
        $theme = session("theme", config("theme.default"));
        $lang = session("lang", config("app.locale"));

        $request->user()->remove();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->put("theme", $theme);
        session()->put("lang", $lang);

        return redirect(route("welcome"));
    }
}
