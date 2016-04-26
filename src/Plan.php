<?php

namespace AcceptOn;

/**
 * A recurring billing plan that bills after a period of time.
 *
 * @property integer $amount The amount of the plan in cents.
 * @property string $createdAt Date and time the plan was created in ISO-8601 format.
 * @property string $currency The ISO currency code of the plan.
 * @property string $id The plan identifier.
 * @property string $name The name of the plan.
 * @property string $periodUnit The billing frequency unit of the plan.
 */
class Plan extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "amount" => "int",
        "createdAt" => "date",
        "currency" => "string",
        "id" => "string",
        "name" => "string",
        "periodUnit" => "string",
    );
}
