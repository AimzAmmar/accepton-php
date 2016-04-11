<?php

namespace AcceptOn;

use \Http\Client\HttpClient;

use \AcceptOn\Error\Error;

class Request
{
    /* @var AcceptOn\Client */
    public $client;

    /* @var string The type of request to create (i.e. "get") */
    public $requestMethod;

    /* @var AcceptOn\Headers The headers for the request. */
    public $headers;

    /* @var mixed[] Any options for the request. */
    public $options;

    /* @var string The path of the request. */
    public $path;

    const URLS = array(
        "development" => "http://checkout.accepton.dev",
        "test" => "http://localhost:8082",
        "staging" => "https://staging-checkout.accepton.com",
        "production" => "https://checkout.accepton.com"
    );

    /**
     * Creates a new Request that can be sent to the specified path.
     *
     * @param AcceptOn\Client $client The client that created the request.
     * @param string $requestMethod The type of request to perform.
     * @param string $path The path to request.
     * @param mixed[] $options Any options for the request.
     */
    public function __construct($client, $requestMethod, $path, $options = null)
    {
        $options = array_merge($this->defaultOptions(), $options);
        $url = self::URLS[$options["environment"]];
        unset($options["environment"]);
        $this->client = $client;
        $this->requestMethod = $requestMethod;
        $this->options = $options;
        $this->path = $url . $path;
        $headers = new \AcceptOn\Headers($client);
        $this->headers = $headers->requestHeaders();
    }

    /**
     * Sends the request and parses the body into a model or throws an error.
     *
     * @throws AcceptOn\Error if the response failed (non-2xx response).
     *
     * @return mixed The parsed response.
     */
    public function perform()
    {
        $response = $this->http()->sendRequest($this->createRequest());

        return $this->throwOrReturnResponseBody($response->getBody(), $response->getStatusCode());
    }

    /**
     * @return Psr\Http\Message\RequestInterface
     */
    private function createRequest()
    {
        $body = $this->options;

        if ($this->requestMethod === "get") {
            $uri = $this->path . "?" . $this->encodeFields();
            $body = null;
        } else {
            $uri = $this->path;
            $body = json_encode($body);
        }

        return $this->messageFactory()->createRequest(
            $this->requestMethod,
            $uri,
            $this->headers,
            $body
        );
    }

    /**
     * @return mixed[]
     */
    private function defaultOptions()
    {
        return array("environment" => "production");
    }

    /**
     * @return string
     */
    private function encodeFields()
    {
        $fields = array();
        foreach ($this->options as $key => $value) {
            $fields[urlencode($key)] = urlencode($value);
        }

        $fieldsString  = "";
        foreach ($fields as $key => $value) {
            $fieldsString .= $key . "=" . $value . "&";
        }
        $fieldsString = rtrim($fieldsString, "&");

        return $fieldsString;
    }

    /**
     * @return Http\Client\HttpClient
     */
    private function http()
    {
        return $this->client->http();
    }

    /**
     * @return Http\Message\MessageFactory
     */
    private function messageFactory()
    {
        return $this->client->messageFactory();
    }

    /**
     * @throws AcceptOn\Error if the response failed (non-2xx response).
     *
     * @return mixed
     */
    private function throwOrReturnResponseBody($body, $statusCode)
    {
        $error = Error::fromResponse($body, $statusCode);

        if (isset($error)) {
            throw $error;
        }

        return json_decode($body);
    }
}
