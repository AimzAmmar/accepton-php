<?php

namespace AcceptOn;

class Headers {

  public $client;

  public function __construct($client) {
    $this->client = $client;
  }

  public function request_headers() {
    $headers = array(
      "accept" => "application/json",
      "authorization" => $this->bearer_auth_header(),
      "user_agent" => $this->client->user_agent(),
    );

    return $headers;
  }

  public function bearer_auth_header() {
    return "Bearer ".$this->client->api_key;
  }

}
