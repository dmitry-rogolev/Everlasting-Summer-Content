<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    protected string $header;

    public function __construct()
    {
        parent::__construct(config("view.title"));

        $this->header = config("app.name");
    }
    
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $this->theme($request);

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('auth.verify-email', 
                    [
                        "title" => $this->title, 
                        "header" => $this->header, 
                        "theme" => $this->theme, 
                        "themes" => $this->themes, 
                        "inversion_themes" => $this->inversionThemes, 
                    ]);
    }
}
