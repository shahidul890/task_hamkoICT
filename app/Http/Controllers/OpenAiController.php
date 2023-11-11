<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Traits\OpenAI;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    use OpenAI;

    protected $authUser;
    protected $authId;

    public function __construct() 
    {
        $this->middleware("auth");

        $this->middleware(function($request, $next){
            $this->authId = auth()->id();
            $this->authUser = auth()->user();

            return $next($request);
        });
        
    }

    /**
     * ---------------------------------------------------------
     *  get existing chat history
     * ---------------------------------------------------------
     */
    public function existingChatHistory(Request $request)
    {
        return $this->getHistory();
    }


    /**
     * ---------------------------------------------------------
     *  create Chat
     * ---------------------------------------------------------
     */
    public function requestSubmit(Request $request)
    {
        try 
        {
            $query = $request->message;

            $raw = $this->storeQuery($query);

            $res = $this->openChat($query);

            $this->storeReply($raw->id, $res['choices'][0]['message']['content']);

            return $this->getHistory();

        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }



    protected function storeQuery($query)
    {
        return Chat::create([
            "user_id"   =>  $this->authId,
            "query" =>  $query
        ]);
    }



    protected function storeReply($queryId, $reply)
    {
        return Chat::find($queryId)
        ->update([
            "reply" => $reply
        ]);
    }



    protected function getHistory()
    {
        return Chat::where("user_id", $this->authId)->get();
    }
}
