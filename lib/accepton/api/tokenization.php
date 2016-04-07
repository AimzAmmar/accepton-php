<?php

namespace AcceptOn;

trait Tokenization
{
    public function createToken(
        $amount,
        $application_fee = null,
        $currency = "usd",
        $description = null,
        $merchant_paypal_account = null
    ) {
        if (is_array($amount) && isset($amount["amount"])) {
            $values = $amount;
            $options = array(
                "amount" => $values["amount"],
                "application_fee" => $this->valueWithDefault($values["application_fee"]),
                "currency" => $this->valueWithDefault($values["currency"], "usd"),
                "description" => $this->valueWithDefault($values["description"]),
                "merchant_paypal_account" => $this->valueWithDefault($values["merchant_paypal_account"]),
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

        if (isset($this->environment)) {
            $options["environment"] = $this->environment;
        }

        return $this->performPostWithObject("/v1/tokens", $options, "AcceptOn\TransactionToken");
    }

    private function valueWithDefault($value, $default = null)
    {
        $newValue = $default;

        if (isset($value)) {
            $newValue = $value;
        }

        return $newValue;
    }
}
