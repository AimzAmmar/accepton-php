<?php

namespace AcceptOn;

trait Refunding
{

    public function refund($amount, $charge_id)
    {
        return $this->perform_post_with_object(
            "/v1/refunds",
            array(
            "amount" => $amount,
            "charge_id" => $charge_id,
            "environment" => $this->environment,
            ),
            "AcceptOn\Refund"
        );
    }
}
