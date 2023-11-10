<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware("guest");
    }


    /**
     * ------------------------------------------------------------
     *  show login blade.
     * ------------------------------------------------------------
     */
    public function showLogin()
    {
        return view("auth.login");
    }


    /**
     * ------------------------------------------------------------
     *  handle login request.
     * ------------------------------------------------------------
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function login(Request $request)
    {
        $this->validateInputs($request);

        if(auth()->attempt($this->credentials($request), $request->boolean("remember")))
        {
            return redirect($this->redirectTo);
        }

        return back()->withInput()->withErrors("email.required", "These credentials does not match our records.");
    }


    /**
     * ------------------------------------------------------------
     *  Get validator for an incoming signup request.
     * ------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateInputs(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required|min:6",
        ],[
            "email.exists" => "This email does not exists our records."
        ]);
    }


    /**
     * -------------------------------------------------------------
     *  Get the needed authorization credentials from the request.
     * -------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }
}
