<?php

namespace AcceptOn;

require_once('utils.php');

trait Tokenization {

  public function create_token($amount, $application_fee = null, $currency = "usd", $description = null, $merchant_paypal_account = null) {
    if (is_array($amount) && isset($amount["amount"])) {
      $values = $amount;
      $options = array(
        "amount" => $values["amount"],
        "application_fee" => isset($values["application_fee"]) ? $values["application_fee"] : null,
        "currency" => isset($values["currency"]) ? $values["currency"] : "usd",
        "description" => isset($values["description"]) ? $values["description"] : null,
        "merchant_paypal_account" => isset($values["merchant_paypal_account"]) ? $values["merchant_paypal_account"] : null,
      );
    } else {
      $options = array(
        "amount" => $amount,
        "application_fee" => $application_fee,
        "currency" => $currency,
        "description" => $description,
        "merchant_paypal_account" => $merchant_paypal_account,
      );
    }

    if (isset($this->environment)) $options['environment'] = $this->environment;

    return $this->perform_post_with_object('/v1/tokens', $options, "AcceptOn\TransactionToken");
  }
}
