<?php

namespace AcceptOn;

class Charge extends \AcceptOn\Base {

    # amount [Integer] The amount charged in cents
    # application_fee [Integer] The application fee by the application owner in cents
    # currency [String] The ISO code of the currency charged
    # description [String] The description of the charge
    # id [String] The charge identifier
    # metadata [Hash] Any metadata about the charge
    # refunded [Boolean] Whether the charge has been refunded
    # remoted_id [String] The charge identifier on the processor
    # status [String] The status of the charge
    public $amount, $application_fee, $currency, $description, $id, $metadata, $refunded, $remote_id, $status;

    # created_at [Date] Date and time of the charge
    public $created_at;

}


class ChargeList extends \AcceptOn\Base {

	public $data;
	public $object;
	public $total;

}