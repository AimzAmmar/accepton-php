<?php

namespace AcceptOn;

/**
 * A charge to a customer.
 *
 * @property integer $amount The amount of the refund in cents.
 * @property array $created Date and time of the charge.
 * @property string $currency The ISO code of the currencey charged.
 * @property string $id The charge identifier.
 * @property mixed[] $metadata Any metadata about the charge.
 * @property string $reason The reason for the refund.
 * @property string $remoteId The charge identifier on the processor.
 */
class Refund extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "amount" => "int",
        "created" => "date",
        "currency" => "string",
        "id" => "string",
        "metadata" => "object",
        "reason" => "string",
        "remoteId" => "string",
    );
}
