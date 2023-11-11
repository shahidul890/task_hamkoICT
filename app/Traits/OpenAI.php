<?php

namespace App\Traits;

trait OpenAI
{
    protected $OPENAI_TOKEN;

    protected $OPENAI_API;

    
    public function __construct() 
    {
        $this->OPENAI_TOKEN = env("OPENAI_SECRET_KEY");
        $this->OPENAI_API = env("OPENAI_API_URL");
    }


    /**
     * ----------------------------------------------------------
     *  Open Chat
     * ----------------------------------------------------------
     */
    public function openChat(string $message)
    {
        $headers = $this->headers();

        $body = $this->postFields($message);

        $result = $this->sendHttp($body, $headers);

        return $result;
    }


    /**
     * ------------------------------------------------------
     *  CURL HTTPHEADER
     * ------------------------------------------------------
     * 
     * @return array
     */
    protected function headers(): array
    {
        return  [
            "Content-Type:application/json",
            "Authorization:Bearer $this->OPENAI_TOKEN"
        ];
    }


    /**
     * ------------------------------------------------------
     *  CURL POSTFIELDS 
     * ------------------------------------------------------
     * 
     * @param string $message
     * @return array
     */
    protected function postFields(string $message): array
    {
        return  [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role"=> "user",
                    "content"=> $message
                ]
            ]
        ];
    }


    /**
     * ---------------------------------------------------------
     *  send http request (POST METHOD)
     * ---------------------------------------------------------
     * 
     * @param array $postFields
     * @param array $headers
     * @return array
     */
    protected function sendHttp(array $postFields, array $headers): array
    {
        ini_set('max_execution_time', 1200);

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->OPENAI_API);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $curl_response = curl_exec($ch);

		$result = json_decode($curl_response,true);

        return $result;
    }
}