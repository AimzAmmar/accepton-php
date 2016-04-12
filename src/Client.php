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
     *
     * @return AcceptOn\Client
     */
    public function __construct($apiKey, $environment = "production")
    {
        $this->apiKey = $apiKey;
        $this->environment = $environment;
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
     * Sets the HTTPClient used to make requests.
     *
     * @api public
     *
     * @param \Http\Client\HttpClient $httpClient
     *
     * @return void
     */
    public function setHttpClient($httpClient)
    {
        $this->http = $httpClient;
    }

    /**
     * Sets the MessageFactory used to make requests.
     *
     * @api public
     *
     * @param \Http\Message\MessageFactory $messageFactory
     *
     * @return void
     */
    public function setMessageFactory($messageFactory)
    {
        $this->messageFactory = $messageFactory;
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
