<?php

namespace AcceptOn;

use \Http\Discovery\HttpClientDiscovery;
use \Http\Discovery\MessageFactoryDiscovery;
use \Http\Message\MessageFactory;

class Client
{
    use Querying;
    use Refunding;
    use Tokenization;
    use Utils;

    public $apiKey;
    public $environment;
    private $http;
    private $messageFactory;

    public function __construct($apiKey, $environment = "production", $http = null, $messageFactory = null)
    {
        $this->apiKey = $apiKey;
        $this->environment = $environment;
        $this->http = $http;
        $this->messageFactory = $messageFactory;
    }

    public function hasApiKey()
    {
        return $this->apiKey != null && is_string($this->apiKey);
    }

    public function http()
    {
        if (isset($this->http)) {
            return $this->http;
        }

        return HttpClientDiscovery::find();
    }

    public function messageFactory()
    {
        if (isset($this->messageFactory)) {
            return $this->messageFactory;
        }

        return MessageFactoryDiscovery::find();
    }

    public static function userAgent()
    {
        return "accepton-php/" . ACCEPTON_VERSION;
    }
}
