<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Plan extends \AcceptOn\Base
{
    /** @var integer The amount of the plan in cents. */
    public $amount;

    /** @var string The ISO currency code of the plan. */
    public $currency;

    /** @var string Date and time the plan was created in ISO-8601 format. */
    public $createdAt;

    /** @var string The plan identifier. */
    public $id;

    /** @var string The name of the plan. */
    public $name;

    /** @var string The billing frequency unit of the plan. */
    public $periodUnit;
}
