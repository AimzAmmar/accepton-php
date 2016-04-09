<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class TransactionToken extends \AcceptOn\Base
{
    public $amount;
    public $application_fee;
    public $created;
    public $description;
    public $id;
    public $merchant_paypal_account;
}
