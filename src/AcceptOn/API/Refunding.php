<?php

namespace AcceptOn;

trait Refunding
{
    public function refund($params = array())
    {
        return $this->performPostWithObject(
            "/v1/refunds",
            $params,
            "AcceptOn\Refund"
        );
    }
}
