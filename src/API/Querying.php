<?php

namespace AcceptOn\API;

trait Querying
{
    /**
     * Retrieves a charge from the API.
     *
     * @api public
     *
     * @param string $chargeId The charge identifier.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Charge
     */
    public function charge($chargeId)
    {
        return $this->performGetWithObject(
            "/v1/charges/" . $chargeId,
            array(),
            "AcceptOn\Charge"
        );
    }

    /**
     * Retrieves a page of charges from the API.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option string "end_date" The latest date for charges to be created (ISO-8601).
     * @option string "start_date" The earliest date for charges to be created (ISO-8601).
     * @option string "order" The order to sort by ("asc" or "desc").
     * @option string "order_by" The field to order by (e.g. "created_at").
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Charge
     */
    public function charges($params = array())
    {
        return $this->performGetWithObjects(
            "/v1/charges",
            $params,
            "AcceptOn\Charge"
        );
    }
}
