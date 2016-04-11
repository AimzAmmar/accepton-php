<?php

namespace AcceptOn;

use \Http\Discovery\HttpClientDiscovery;
use \Http\Discovery\MessageFactoryDiscovery;
use \Http\Message\MessageFactory;

class Client
{
    use API\Querying;
    use API\Refunding;
    use API\Tokenization;
    use API\Utils;

    /* @var string The API key to use when connecting to AcceptOn. */
    public $apiKey;

    /* @var string The environment to use when connecting. */
    public $environment;

    /*
     * @api private
     *
     * @var Http\Client\HttpClient The HttpClient used to connect.
     */
    private $http;

    /*
     * @api private
     *
     * @var Http\Message\MessageFactory The MessageFactory used to connect.
     */
    private $messageFactory;

    /*
     * Initializes a new Client object.
     *
     * @param string $apiKey The API key to use when connecting to AcceptOn.
     * @param string $environment The environment to use when connecting.
     * @param Http\Client\HttpClient $http The HTTP client for sending messages to AcceptOn.
     * @param Http\Message\MessageFactory $messageFactory The factory for creating HTTP messages.
     *
     * @return AcceptOn\Client
     */
    public function __construct($apiKey, $environment = "production", $http = null, $messageFactory = null)
    {
        $this->apiKey = $apiKey;
        $this->environment = $environment;
        $this->http = $http;
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return bool
     */
    public function hasApiKey()
    {
        return $this->apiKey != null && is_string($this->apiKey);
    }

    /**
     * Uses php-http discovery to discover an HTTP client if one isn't set.
     *
     * @return Http\Client\HttpClient
     */
    public function http()
    {
        if (isset($this->http)) {
            return $this->http;
        }

        return HttpClientDiscovery::find();
    }

    /**
     * Uses php-http discovery to discover a message factory if one isn't set.
     *
     * @return Http\Message\MessageFactory
     */
    public function messageFactory()
    {
        if (isset($this->messageFactory)) {
            return $this->messageFactory;
        }

        return MessageFactoryDiscovery::find();
    }

    /**
     * Creates the User-Agent string sent with HTTP requests.
     *
     * @return string
     */
    public static function userAgent()
    {
        return "accepton-php/" . AcceptOn::VERSION;
    }
}
