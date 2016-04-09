<?php

namespace AcceptOn;

trait Querying
{
    public function charge($chargeId)
    {
        return $this->performGetWithObject(
            "/v1/charges/" . $chargeId,
            array(),
            "AcceptOn\Charge"
        );
    }

    public function charges($params = array())
    {
        return $this->performGetWithObjects(
            "/v1/charges",
            $params,
            "AcceptOn\Charge"
        );
    }
}
