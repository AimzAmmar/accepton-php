<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Charge extends \AcceptOn\Base
{
    /** @var integer The amount in cents of the charge. */
    public $amount;

    /** @var integer The amount in cents to apply as an application fee. */
    public $applicationFee;

    /** @var string Date and time of the charge in ISO-8601 format. */
    public $createdAt;

    /** @var string The ISO code of the currency charged. */
    public $currency;

    /** @var string The description of the charge. */
    public $description;

    /** @var string The charge identifier. */
    public $id;

    /** @var mixed[] Any metadata about the charge. */
    public $metadata;

    /** @var bool Whether the charge has been refunded. */
    public $refunded;

    /** @var string The charge identifier on the processor. */
    public $remoteId;

    /** @var string The status of the charge. */
    public $status;
}
