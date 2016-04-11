<?php

namespace AcceptOn;

class Headers
{
    /* @var AcceptOn\Client */
    public $client;

    /**
     * Creates a convenience object for handling HTTP headers.
     *
     * @param AcceptOn\Client $client The client that will send the HTTP requests.
     * @return AcceptOn\Headers
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Constructs an array of headers for HTTP requests.
     *
     * @return string[]
     */
    public function requestHeaders()
    {
        $headers = array(
            "Accept" => "application/json",
            "Authorization" => $this->bearerAuthHeader(),
            "User-Agent" => $this->client->userAgent(),
        );

        return $headers;
    }

    /**
     * Constructs the authorization header
     *
     * @api private
     *
     * @return string
     */
    private function bearerAuthHeader()
    {
        return "Bearer " . $this->client->apiKey;
    }
}
