<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    protected ?User $user;

    protected bool $can;

    public function show(Request $request, User $user = null)
    {
        $this->settings(null, true);

        $this->can = $this->can();

        if (Auth::check() && $request->user()->can("show", $user))
            return redirect(route("profile"));
        
        $this->user = $this->can ? $request->user() : $user;

        if ($this->can)
        {
            $breadcrumbs = new Collection([
                new Collection([
                    "name" => __("page.welcome"), 
                    "url" => route("welcome"), 
                    __("page.welcome"), 
                    route("welcome"), 
                ]), 
                new Collection([
                    "name" => __("page.profile.header"), 
                    "url" => route("profile"), 
                    __("page.profile.header"), 
                    route("profile"), 
                ]), 
            ]);
        }
        else 
        {
            $breadcrumbs = new Collection([
                new Collection([
                    "name" => __("page.welcome"), 
                    "url" => route("welcome"), 
                    __("page.welcome"), 
                    route("welcome"), 
                ]), 
                new Collection([
                    "name" => $this->user->name, 
                    "url" => url($this->user->id), 
                    $this->user->name, 
                    url($this->user->id), 
                ]), 
                new Collection([
                    "name" => __("page.profile.header"), 
                    "url" => url($this->user->id . "/profile"), 
                    $this->user->name, 
                    url($this->user->id . "/profile"), 
                ]), 
            ]);
        }

        $this->breadcrumbs($breadcrumbs);

        $avatar = $this->user->avatar;

        return view("profile", $this->data->merge([

            "header" => __("page.profile.header"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "can" => $this->can,
            "user" => $this->user,  

            "avatar" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "path" => 
                    $avatar
                    ? "/storage/avatars/" . $this->user->id . "/" . $avatar->title . "." . $avatar->extension 
                    : "", 
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
        ->all()
        );
    }

    public function avatar(Request $request)
    {
        $request->validate([
            "avatar" => [ "required", "image", "mimes:jpg,jpeg,png,gif", "max:4096" ], 
        ]);

        $new_avatar = $request->file("avatar");
        $old_avatar = $request->user()->avatar;

        if ($old_avatar)
        {
            Storage::disk("public")->delete("avatars/" . $request->user()->id . "/" . $old_avatar->title . "." . $old_avatar->extension);
            
            $old_avatar->title = Str::of($new_avatar->getClientOriginalName())->beforeLast(".");
            $old_avatar->extension = $new_avatar->extension();
            $old_avatar->type = $new_avatar->getClientMimeType();
            $old_avatar->save();
        }
        else 
        {
            Avatar::create([
                "title" => Str::of($new_avatar->getClientOriginalName())->beforeLast("."), 
                "extension" => $new_avatar->extension(), 
                "type" => $new_avatar->getClientMimeType(), 
                "user_id" => $request->user()->id, 
            ]);
        }

        $new_avatar->storeAs("avatars/" . $request->user()->id, $new_avatar->getClientOriginalName(), "public");

        return back();
    }

    public function name(Request $request)
    {
        $request->validate([
            "name" => [ "required", "string", "max:255" ], 
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return back();
    }

    public function email(Request $request)
    {
        $request->validate([
            "email" => [ "required", "string", "email", "max:255", new \App\Rules\User\Unique() ], 
        ]);

        $user = $request->user();
        $user->email = $request->email;
        $user->save();

        event(new Registered($user));

        return back();
    }

    public function emailVisibility(Request $request)
    {
        // $request->validate([
        //     "email_visibility" => [ "null" ], 
        // ]);

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
        
        $user = $request->user();
        
        $user->password = Hash::make($request->password);
        $user->save();

        return back();
    }

    protected function can()
    {
        if (path() === "profile")
            return true;

        return false;
    }
}
