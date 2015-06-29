<?php

namespace AcceptOn;

require_once('utils.php');

trait Tokenization {

  public function create_token($amount, $application_fee = null, $currency = "usd", $description = null, $merchant_paypal_account = null) {
    $options = array(
      "amount" => $amount,
      "application_fee" => $application_fee,
      "currency" => $currency,
      "description" => $description,
      "merchant_paypal_account" => $merchant_paypal_account,
    );

    if (isset($this->environment)) $options['environment'] = $this->environment;

    return $this->perform_post_with_object('/v1/tokens', $options, "AcceptOn\TransactionToken");
  }
}
