<?php

namespace App\Http\Controllers;

use App\Traits\OpenAI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    use OpenAI;

    public function __construct()
    {
        $this->middleware("auth");
        
    }


    /**
     * -------------------------------------------------
     *  Show home page
     * -------------------------------------------------
     */
    public function home()
    {
        // $this->openChat();
    }
}
