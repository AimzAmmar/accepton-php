<?php

namespace AcceptOn;

trait Querying
{
    public function charge($id)
    {
        return $this->performGetWithObject(
            "/v1/charges/".$id,
            array("environment" => $this->environment),
            "AcceptOn\Charge"
        );
    }

    public function charges(
        $amount,
        $charge_id,
        $start_date = null,
        $end_date = null,
        $order_by = null,
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
                "charge_id" => $charge_id,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "order_by" => $order_by,
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
