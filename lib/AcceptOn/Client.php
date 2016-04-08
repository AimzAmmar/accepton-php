<?php

namespace AcceptOn;

class Client
{
    use Querying;
    use Refunding;
    use Tokenization;
    use Utils;

    public $apiKey;
    public $environment;

    public function __construct($apiKey, $environment = "production")
    {
        $this->apiKey = $apiKey;
        $this->environment = $environment;
    }

    public function hasApiKey()
    {
        return $this->apiKey != null && is_string($this->apiKey);
    }

    public static function userAgent()
    {
        return "accepton-php/" . ACCEPTON_VERSION;
    }
}
