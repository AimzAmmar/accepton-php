<?php

namespace AcceptOn;

trait Refunding
{

    public function refund($amount, $chargeId)
    {
        return $this->perform_post_with_object(
            "/v1/refunds",
            array(
            "amount" => $amount,
            "chargeId" => $chargeId,
            "environment" => $this->environment,
            ),
            "AcceptOn\Refund"
        );
    }
}
