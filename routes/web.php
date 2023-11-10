<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return redirect('/login');});
Route::get("login", [LoginController::class, 'showLogin']);
Route::get("signup", [SignupController::class, "showSignup"]);

Route::post("login", [LoginController::class, 'login'])->name("login");
Route::post("signup", [SignupController::class, 'signup'])->name("signup");

Route::get("/home", function(){
    return auth()->user();
});

Route::get("logout", function(){
    auth()->logout();
    return redirect("/login");
});