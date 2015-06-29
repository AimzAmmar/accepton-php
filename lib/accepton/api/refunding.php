<?php

namespace AcceptOn;

require_once('utils.php');

trait Refunding {

  public function refund($amount, $authorization_id) {
    return $this->perform_post_with_object(
  	  '/v1/refunds',
      array(
        "amount" => $amount,
        "authorization_id" => $authorization_id,
      ),
      "AcceptOn\Refund");
  }

}
