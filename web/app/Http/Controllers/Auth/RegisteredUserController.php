<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\User as UserRules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->settings();

        return view('auth.register', $this->data->merge([

            "header" => config("app.name"), 

        ])
        ->all()
        );
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new UserRules\Unique()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole("user");

        event(new Registered($user));

        Auth::login($user);

        $this->createDefaultFolder($user);

        return redirect(route("user", [ "user" => $user->id ]));
    }

    private function createDefaultFolder(User $user) : Folder
    {
        return Folder::create([
            "title" => null, 
            "path" => null, 
            "visibility" => false, 
            "folder_id" => null, 
            "user_id" => $user->id, 
        ]);
    }
}
