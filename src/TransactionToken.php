<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class TransactionToken extends \AcceptOn\Base
{
    /** @var integer The amount of the transaction in cents. */
    public $amount;

    /** @var integer The amount in cents to apply as an application fee. */
    public $applicationFee;

    /** @var string Date and time the token was created in ISO-8601 format. */
    public $created;

    /** @var string The description of the transaction. */
    public $description;

    /** @var string The token identifier. */
    public $id;

    /** @var The merchant's PayPal account when paying a merchant other than yourself. */
    public $merchantPaypalAccount;
}
