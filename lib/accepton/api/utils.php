<?php

namespace AcceptOn;

trait Utils
{
    public static function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    private function performGetWithObject($path, $params, $klass)
    {
        return $this->performRequestWithObject("get", $path, $params, $klass);
    }

    private function performPostWithObject($path, $params, $klass)
    {
        return $this->performRequestWithObject("post", $path, $params, $klass);
    }

    private function performRequest($request_method, $path, $params)
    {
        $request = new \AcceptOn\Request($this, $request_method, $path, $this->withEnvironment($params));
        return $request->perform();
    }

    private function performRequestWithObject($request_method, $path, $params, $klass)
    {
        $response = $this->performRequest($request_method, $path, $params);
        return new $klass($response);
    }

    private function withEnvironment($params)
    {
        $params["environment"] = $this->environment;
        return $params;
    }
}
