<?php

namespace AcceptOn;

class Headers
{
    public $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function requestHeaders()
    {
        $headers = array(
            "accept" => "application/json",
            "authorization" => $this->bearerAuthHeader(),
            "user_agent" => $this->client->userAgent(),
        );

        return $headers;
    }

    private function bearerAuthHeader()
    {
        return "Bearer ".$this->client->apiKey;
    }
}
