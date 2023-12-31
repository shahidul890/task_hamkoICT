<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpenAiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return redirect('/login');});
Route::get("login", [LoginController::class, 'showLogin']);
Route::get("signup", [SignupController::class, "showSignup"]);

Route::post("login", [LoginController::class, 'login'])->name("login");
Route::post("signup", [SignupController::class, 'signup'])->name("signup");

Route::get("/home", [HomeController::class, 'home']);
Route::get("/profile", [HomeController::class, 'profile']);

Route::any("openai/chat",[OpenAiController::class, 'requestSubmit']);
Route::get("openai/chat/history", [OpenAiController::class, 'existingChatHistory']);

Route::get("logout", function(){
    auth()->logout();
    return redirect("/login");
});