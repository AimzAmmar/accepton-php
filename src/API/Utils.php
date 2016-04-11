<?php

namespace AcceptOn\API;

trait Utils
{
    /**
     * @param string $path
     * @param mixed[] $params
     * @param string $klass
     *
     * @return $klass
     */
    private function performGetWithObject($path, $params, $klass)
    {
        return $this->performRequestWithObject("get", $path, $params, $klass);
    }

    /**
     * @param string $path
     * @param mixed[] $params
     * @param string $klass
     *
     * @return $klass[]
     */
    private function performGetWithObjects($path, $params, $klass)
    {
        return $this->performRequestWithObjects("get", $path, $params, $klass);
    }

    /**
     * @param string $path
     * @param mixed[] $params
     * @param string $klass
     *
     * @return $klass
     */
    private function performPostWithObject($path, $params, $klass)
    {
        return $this->performRequestWithObject("post", $path, $params, $klass);
    }

    /**
     * @param string $requestMethod
     * @param string $path
     * @param mixed[] $params
     *
     * @return mixed
     */
    private function performRequest($requestMethod, $path, $params)
    {
        $request = new \AcceptOn\Request($this, $requestMethod, $path, $this->withEnvironment($params));
        return $request->perform();
    }

    /**
     * @param string $requestMethod
     * @param string $path
     * @param mixed[] $params
     * @param string $klass
     *
     * @return $klass
     */
    private function performRequestWithObject($requestMethod, $path, $params, $klass)
    {
        $response = $this->performRequest($requestMethod, $path, $params);
        return new $klass($response);
    }

    /**
     * @param string $requestMethod
     * @param string $path
     * @param mixed[] $params
     * @param string $klass
     *
     * @return $klass[]
     */
    private function performRequestWithObjects($requestMethod, $path, $params, $klass)
    {
        $response = $this->performRequest($requestMethod, $path, $params);
        $objects = array();

        foreach ($response->data as $object) {
            array_push($objects, new $klass($object));
        }

        return $objects;
    }

    /**
     * @param mixed[] $params
     *
     * @return mixed[]
     */
    private function withEnvironment($params)
    {
        $params["environment"] = $this->environment;

        return $params;
    }
}
