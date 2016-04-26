<?php

namespace AcceptOn;

/**
 * A promo code that applies a promotion to a charge.
 *
 * @property string $createdAt The time the promo code was created.
 * @property string $name The promo code as given to a customer.
 * @property string $promoType The type of promo code. One of: "amount", "fixed_price", or "percentage".
 * @property int|float $value The amount of discount to apply, based on the type. If $promoType is "amount" or
 *     "fixed_price", an integer amount in cents. If $promoType is "percentage", a decimal percentage.
 */
class PromoCode extends \AcceptOn\Base
{
    protected static $allowedProperties = array(
        "createdAt" => "date",
        "name" => "string",
        "promoType" => "string",
        "value" => null,
    );
}
