<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function show(Request $request, User $user)
    {
        $this->settings();

        $this->can = $this->can("show", $user);

        $breadcrumbs = $this->breadcrumbs($this->createBreadcrumbs($user));

        $this->setBreadcrumbs($breadcrumbs);

        return view("user", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "can" => $this->can,
            "user" => $user,  

            "avatar" => new Collection([
                "id" => id(), 
                "labelledby" => id(),
            ]),

            "name" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "email" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "password" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

        ])
        ->all());
    }

    public function name(Request $request)
    {
        $request->validate([
            "name" => [ "required", "string", "max:255" ], 
        ]);

        $request->user()->name = $request->name;
        $request->user()->save();

        return back();
    }

    public function email(Request $request)
    {
        $request->validate([
            "email" => [ "required", "string", "email", "max:255", new \App\Rules\User\Unique() ], 
        ]);

        $request->user()->email = $request->email;
        $request->user()->save();

        event(new Registered($request->user()));

        return back();
    }

    public function emailVisibility(Request $request)
    {
        $request->user()->email_visibility = !boolval($request->email_visibility);
        $request->user()->save();

        return back();
    }

    public function password(Request $request)
    {
        $request->validate([
            "old_password" => [ "required", Rules\Password::defaults() ], 
            "password" => [ "required", "confirmed", Rules\Password::defaults() ]
        ]);

        if (!Hash::check($request->old_password, $request->user()->password))
            back()->withErrors(["old_password" => __("auth.errors.password")]);
        
        $request->user()->password = Hash::make($request->password);
        $request->user()->save();

        return back();
    }

    public function createBreadcrumbs(User $user) : Collection
    {
        return new Collection([
            __("page.welcome") => route("welcome"), 
            $this->can ? __("page.user.header") : $user->name => route("user", [ "user" => $user->id ]), 
        ]);
    }
}
