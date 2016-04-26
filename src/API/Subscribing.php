<?php

namespace AcceptOn\API;

trait Subscribing
{
    /**
     * Cancels a subscription on AcceptOn.
     *
     * @api public
     *
     * @param string $subscriptionId The subscription identifier.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\Subscription
     */
    public function cancelSubscription($subscriptionId)
    {
        return $this->performPostWithObject(
            "/v1/subscriptions/" . $subscriptionId . "/cancel",
            array(),
            "AcceptOn\Subscription"
        );
    }
}
