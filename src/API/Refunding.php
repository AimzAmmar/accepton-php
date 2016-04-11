<?php

namespace AcceptOn\API;

trait Refunding
{
    /**
     * Refunds a charge by the specified amount.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option int "amount" The amount in cents to refund.
     * @option string "charge_id" The id of the charge to refund.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Charge
     */
    public function refund($params = array())
    {
        return $this->performPostWithObject(
            "/v1/refunds",
            $params,
            "AcceptOn\Refund"
        );
    }
}
