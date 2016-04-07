<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.LongVariable)
 */
trait Tokenization
{
    public function createToken(
        $amount,
        $applicationFee = null,
        $currency = "usd",
        $description = null,
        $merchantPaypalAccount = null
    ) {
        if (is_array($amount) && isset($amount["amount"])) {
            $values = $amount;
            $options = array(
                "amount" => $values["amount"],
                "applicationFee" => $this->valueWithDefault($values["applicationFee"]),
                "currency" => $this->valueWithDefault($values["currency"], "usd"),
                "description" => $this->valueWithDefault($values["description"]),
                "merchantPaypalAccount" => $this->valueWithDefault($values["merchantPaypalAccount"]),
            );
        } else {
            $options = array(
                "amount" => $amount,
                "applicationFee" => $applicationFee,
                "currency" => $currency,
                "description" => $description,
                "merchantPaypalAccount" => $merchantPaypalAccount,
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
