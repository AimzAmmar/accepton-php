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

    /**
     * Retrieves a plan from the API.
     *
     * @api public
     *
     * @param string $planId The plan identifier.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Plan
     */
    public function plan($planId)
    {
        return $this->performGetWithObject(
            "/v1/recurring/plans/" . $planId,
            array(),
            "AcceptOn\Plan"
        );
    }

    /**
     * Retrieves a page of plans from the API.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option string "order" The order to sort by ("asc" or "desc").
     * @option string "order_by" The field to order by (e.g. "created_at").
     * @option int "page" The page number to retrieve.
     * @option int "per_page" The size of the page to retrieve (max: 100).
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Plan[]
     */
    public function plans($params = array())
    {
        return $this->performGetWithObjects(
            "/v1/recurring/plans",
            $params,
            "AcceptOn\Plan"
        );
    }

    /**
     * Retrieves a promo code from the API.
     *
     * @api public
     *
     * @param string $promoCodeId The promo code name.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\PromoCode
     */
    public function promoCode($promoCodeName)
    {
        return $this->performGetWithObject(
            "/v1/promo_codes/" . $promoCodeName,
            array(),
            "AcceptOn\PromoCode"
        );
    }

    /**
     * Retrieves a page of promo codes from the API.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option string "order" The order to sort by ("asc" or "desc").
     * @option string "order_by" The field to order by (e.g. "created_at").
     * @option int "page" The page number to retrieve.
     * @option int "per_page" The size of the page to retrieve (max: 100).
     * @option string "promo_type" The type of promo code to filter by.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\PromoCode[]
     */
    public function promoCodes($params = array())
    {
        return $this->performGetWithObjects(
            "/v1/promo_codes",
            $params,
            "AcceptOn\PromoCode"
        );
    }

    /**
     * Retrieves a subscription from the API.
     *
     * @api public
     *
     * @param string $subscriptionId The subscription identifier.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Subscription
     */
    public function subscription($subscriptionId)
    {
        return $this->performGetWithObject(
            "/v1/recurring/subscriptions/" . $subscriptionId,
            array(),
            "AcceptOn\Subscription"
        );
    }

    /**
     * Retrieves a page of subscriptions from the API.
     *
     * @api public
     *
     * @param mixed[] $params An array of query parameters.
     * @option bool "active" Whether to filter for active or inactive subscriptions.
     * @option string "order" The order to sort by ("asc" or "desc").
     * @option string "order_by" The field to order by (e.g. "created_at").
     * @option int "page" The page number to retrieve.
     * @option int "per_page" The size of the page to retrieve (max: 100).
     * @option string "plan_token" The plan identifier to filter by.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Subscription[]
     */
    public function subscriptions($params = array())
    {
        if (isset($params["plan_token"])) {
            $params["plan.token"] = $params["plan_token"];
            unset($params["plan_token"]);
        }

        return $this->performGetWithObjects(
            "/v1/recurring/subscriptions",
            $params,
            "AcceptOn\Subscription"
        );
    }

    /**
     * Retrieves a transaction token from the API.
     *
     * @api public
     *
     * @param string $tokenId The token identifier.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Charge
     */
    public function token($tokenId)
    {
        return $this->performGetWithObject(
            "/v1/tokens/" . $tokenId,
            array(),
            "AcceptOn\TransactionToken"
        );
    }
}
