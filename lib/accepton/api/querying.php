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

    public function charges(
        $amount,
        $chargeId,
        $startDate = null,
        $endDate = null,
        $orderBy = null,
        $order = null
    ) {
        $options = array();
        if (is_array($amount)) {
            $options = $amount;
            if (!isset($options["environment"])) {
                $options["environment"] = $this->environment;
            }
        } else {
            $options = array(
                "amount" => $amount,
                "chargeId" => $chargeId,
                "startDate" => $startDate,
                "endDate" => $endDate,
                "orderBy" => $orderBy,
                "order" => $order,
                "environment" => $this->environment,
            );
        }
        return $this->performGetWithObject(
            "/v1/charges",
            $options,
            "AcceptOn\ChargeList"
        );
    }
}
