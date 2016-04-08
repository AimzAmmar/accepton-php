<?php

namespace AcceptOn;

use \Http\Client\HttpClient;

use \AcceptOn\Error\Error;

class Request
{
    public $client;
    public $requestMethod;
    public $headers;
    public $options;
    public $path;

    private $httpClient;
    private $messageFactory;

    private $urls = array(
        "development" => "http://checkout.accepton.dev",
        "test" => "http://localhost:8082",
        "staging" => "https://staging-checkout.accepton.com",
        "production" => "https://checkout.accepton.com"
    );

    public function __construct($client, $requestMethod, $path, $options = null)
    {
        $options = array_merge($this->defaultOptions(), $options);
        $url = $this->urls[$options["environment"]];
        unset($options["environment"]);
        $this->client = $client;
        $this->requestMethod = $requestMethod;
        $uri = Utils::startsWith($path, "http") ? $path : $url . $path;
        $this->options = $options;
        $this->path = $uri;
        $headers = new \AcceptOn\Headers($client);
        $this->headers = $headers->requestHeaders();
    }

    public function perform()
    {
        $response = $this->http()->sendRequest($this->createRequest());

        return $this->throwOrReturnResponseBody($response->getBody(), $response->getStatusCode());
    }

    private function createRequest()
    {
        $messageFactory = $this->messageFactory();
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

    private function defaultOptions()
    {
        return array("environment" => "production");
    }

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

    private function http()
    {
        return $this->client->http();
    }

    private function messageFactory()
    {
        return $this->client->messageFactory();
    }

    private function throwOrReturnResponseBody($body, $statusCode)
    {
        $error = Error::fromResponse($body, $statusCode);

        if (isset($error)) {
            throw $error;
        }

        return json_decode($body);
    }
}
