<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Refund extends \AcceptOn\Base
{
    /** @var integer The amount in cents of the refund. */
    public $amount;

    /** @var string Date and time of the refund in ISO-8601 format. */
    public $createdAt;

    /** @var string The ISO code of the currency charged. */
    public $currency;

    /** @var string The refund identifier. */
    public $id;

    /** @var mixed[] Any metadata about the refund. */
    public $metadata;

    /** @var string The reason for the refund. */
    public $reason;

    /** @var string The refund identifier on the processor. */
    public $remoteId;
}
