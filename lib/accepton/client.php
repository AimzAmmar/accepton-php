<?php

namespace AcceptOn;

require_once('api/refunding.php');
require_once('api/tokenization.php');
require_once('api/utils.php');

class Client {

  use Tokenization;
  use Refunding;
  use Utils;

  public $api_key, $environment;

  public function __construct($api_key, $environment = "production") {
    $this->api_key = $api_key;
    $this->environment = $environment;
  }

  public function has_api_key() {
    return $this->api_key != null && is_string($this->api_key);
  }

  public static function user_agent() {
    return "accepton-php/".\AcceptOn\VERSION;
  }


}