<?php

namespace AcceptOn;

/**
 * @property bool $active The activity status of the subscription.
 * @property string $email The email belonging to the subscription.
 * @property string $id The subscription identifier.
 * @property string $lastBilledAt The time the subscription was last billed.
 * @property AcceptOn\Plan $plan The plan the subscription is connected to.
 */
class Subscription extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "active" => "bool",
        "email" => "string",
        "id" => "string",
        "lastBilledAt" => "date",
        "plan" => "AcceptOn\Plan",
    );
}
