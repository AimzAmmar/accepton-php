<?php

namespace AcceptOn\API;

trait Planning
{
    /**
     * Creates a plan on AcceptOn.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option int "amount" The plan amount.
     * @option string "currency" The currency to be used, in ISO 4217 format.
     * @option string "name" The plan name.
     * @option string "period_unit" The billing frequency unit, in month or year only.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Plan
     */
    public function createPlan($params = array())
    {
        return $this->performPostWithObject(
            "/v1/recurring/plans",
            $params,
            "AcceptOn\Plan"
        );
    }
}
