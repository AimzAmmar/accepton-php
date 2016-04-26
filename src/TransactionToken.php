<?php

namespace AcceptOn;

/**
 * Represents the configuration for a transaction.
 *
 * @property integer $amount The amount of the transaction in cents.
 * @property integer $applicationFee The amount in cents to apply as an application fee.
 * @property array $created Date and time the token was created.
 * @property string $description The description of the transaction.
 * @property string $id The token identifier.
 * @property string $merchantPaypalAccount The merchant's PayPal account when paying a merchant other than yourself.
 */
class TransactionToken extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "amount" => "int",
        "applicationFee" => "int",
        "created" => "date",
        "description" => "string",
        "id" => "string",
        "merchantPaypalAccount" => "string",
    );
}
