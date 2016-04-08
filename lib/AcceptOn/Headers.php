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
            "Accept" => "application/json",
            "Authorization" => $this->bearerAuthHeader(),
            "User-Agent" => $this->client->userAgent(),
        );

        return $headers;
    }

    private function bearerAuthHeader()
    {
        return "Bearer " . $this->client->apiKey;
    }
}
