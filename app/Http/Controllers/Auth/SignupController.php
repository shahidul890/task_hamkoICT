<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class SignupController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware("guest");
    }


    /**
     * ------------------------------------------------------------
     *  show singup blade.
     * ------------------------------------------------------------
     */
    public function showSignup()
    {
        return view("auth.signup");
    }


    /**
     * ------------------------------------------------------------
     *  handle signup request.
     * ------------------------------------------------------------
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function signup(Request $request)
    {
        $this->validateInputs($request);

        $user = $this->createUser($request->all());

        auth()->loginUsingId($user->id);

        return redirect($this->redirectTo);
    }



    /**
     * ------------------------------------------------------------
     *  Get validator for an incoming signup request.
     * ------------------------------------------------------------
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    function validateInputs(Request $request)
    {
        $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);
    }


    /**
     * ------------------------------------------------------------
     *  Create a new user instance.
     * ------------------------------------------------------------
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createUser(array $data)
    {
        return \App\Models\User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
