<?php

namespace AcceptOn;

class Request
{
    public $client;
    public $requestMethod;
    public $headers;
    public $options;
    public $path;

    private $urls = array(
        "development" => "http://checkout.accepton.dev",
        "staging" => "https://staging-checkout.accepton.com",
        "production" => "https://checkout.accepton.com"
    );

    public function __construct($client, $requestMethod, $path, $options = null)
    {
        $options = array_merge($this->defaultOptions(), $options);
        $url = $this->urls[$options["environment"]];
        unset($options["environment"]);
        $this->client = $client;
        $this->request_method = $requestMethod;
        $uri = Utils::startsWith($path, "http") ? $path : $url . $path;
        $this->options = $options;
        $this->path = $uri;
        $headers = new \AcceptOn\Headers($client);
        $this->headers = $headers->requestHeaders();
    }

    public function perform()
    {
        $curl = curl_init();

        $headers = array();
        foreach ($this->headers as $key => $value) {
            $headers[] = $key . ": " . $value;
        }

        $fields = array();
        foreach ($this->options as $key => $value) {
            $fields[urlencode($key)] = urlencode($value);
        }

        $fieldsString  = "";
        foreach ($fields as $key => $value) {
            $fieldsString .= $key . "=" . $value . "&";
        }
        $fieldsString = rtrim($fieldsString, "&");

        if ($this->request_method == "get") {
            curl_setopt($curl, CURLOPT_URL, $this->path . "?" . $fieldsString);
        } else {
            curl_setopt($curl, CURLOPT_URL, $this->path);
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // disabling SSL verification (for debug only)
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        if (strtolower($this->request_method) == "post") {
            curl_setopt($curl, CURLOPT_POST, count($fields));
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fieldsString);
        }

        return $this->returnResponseOrError($curl);
    }

    private function defaultOptions()
    {
        return array("environment" => "production");
    }

    private function returnResponseOrError($curl)
    {
        $response = curl_exec($curl);
        $error = curl_errno($curl);

        if ($error > 0) {
            // throws Exception if curl generated an error. It different with http errors
            \AcceptOn\Error\Error::curlError($curl);
        }
        $responseInfo = curl_getinfo($curl);
        $code = $responseInfo["http_code"];

        // throws Exception if $response contains an error, else do nothing
        \AcceptOn\Error\Error::fromResponse($response, $code);

        return json_decode($response);
    }
}
