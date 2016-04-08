<?php

namespace AcceptOn;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
class Charge extends \AcceptOn\Base
{
    # amount [Integer] The amount charged in cents
    public $amount;

    # application_fee [Integer] The application fee by the application owner in cents
    public $application_fee;

    # currency [String] The ISO code of the currency charged
    public $currency;

    # description [String] The description of the charge
    public $description;

    # id [String] The charge identifier
    public $id;

    # metadata [Hash] Any metadata about the charge
    public $metadata;

    # refunded [Boolean] Whether the charge has been refunded
    public $refunded;

    # remote_id [String] The charge identifier on the processor
    public $remote_id;

    # status [String] The status of the charge
    public $status;

    # created_at [Date] Date and time of the charge
    public $created_at;
}
