<?php

namespace AcceptOn;

class Request
{
    public $client;
    public $request_method;
    public $headers;
    public $options;
    public $path;

    private $urls = array(
        "development" => "http://checkout.accepton.dev",
        "staging" => "https://staging-checkout.accepton.com",
        "production" => "https://checkout.accepton.com"
    );

    public function __construct($client, $request_method, $path, $options = null)
    {
        $options = array_merge($this->defaultOptions(), $options);
        $url = $this->urls[$options["environment"]];
        unset($options["environment"]);
        $this->client = $client;
        $this->request_method = $request_method;
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

        $fields_string  = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . "=" . $value . "&";
        }
        $fields_string = rtrim($fields_string, "&");

        if ($this->request_method == "get") {
            curl_setopt($curl, CURLOPT_URL, $this->path . "?" . $fields_string);
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
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        }

        return $this->returnResponseOrError($curl);
    }

    private function defaultOptions()
    {
        return array("environment" => "production");
    }

    private function returnResponseOrError($curl)
    {
        $result = curl_exec($curl);
        $error_num = curl_errno($curl);

        if ($error_num > 0) {
            // throws Exception if curl generated an error. It different with http errors
            \AcceptOn\Error\Error::curlError($curl);
        }
        $result_info = curl_getinfo($curl);
        $code = $result_info["http_code"];

        // throws Exception if $result contains an error, else do nothing
        \AcceptOn\Error\Error::fromResponse($result, $code);

        return json_decode($result);
    }
}
