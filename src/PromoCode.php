<?php

namespace AcceptOn;

class PromoCode extends \AcceptOn\Base
{
    /** @var string The time the promo code was created. */
    public $createdAt;

    /** @var string The promo code as given to a customer. */
    public $name;

    /** @var string The type of promo code. One of: "amount", "fixed_price", or "percentage". */
    public $promoType;

    /**
     * @var int|float The amount of discount to apply, based on the type. If $promoType is "amount" or "fixed_price",
     *     an integer amount in cents. If $promoType is "percentage", a decimal percentage.
     */
    public $value;
}
