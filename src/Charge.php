<?php

namespace AcceptOn;

/**
 * A charge to a customer.
 *
 * @property integer $amount The amount of the transaction in cents.
 * @property integer $applicationFee The amount in cents to apply as an application fee.
 * @property array $createdAt Date and time of the charge.
 * @property string $currency The ISO code of the currencey charged.
 * @property string $description The description of the charge.
 * @property string $id The charge identifier.
 * @property mixed[] $metadata Any metadata about the charge.
 * @property bool $refunded Whether the charge has been refunded.
 * @property string $remoteId The charge identifier on the processor.
 * @property string $status The status of the charge.
 */
class Charge extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "amount" => "int",
        "applicationFee" => "int",
        "createdAt" => "date",
        "currency" => "string",
        "description" => "string",
        "id" => "string",
        "metadata" => "object",
        "refunded" => "bool",
        "remoteId" => "string",
        "status" => "string",
    );
}
