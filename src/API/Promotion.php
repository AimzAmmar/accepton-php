<?php

namespace AcceptOn\API;

trait Promotion
{
    /**
     * Creates a promo code on AcceptOn.
     *
     * @api public
     *
     * @param mixed[] $params Attributes to set on the promo code.
     * @option string "name" The promo code name, as given to the customer.
     * @option string "promo_type" The type of promo code ("amount", "percentage", or "fixed_price").
     * @option int|float "value" The promo code amount.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\PromoCode
     */
    public function createPromoCode($params = array())
    {
        return $this->performPostWithObject(
            "/v1/promo_codes",
            $params,
            "AcceptOn\PromoCode"
        );
    }

    /**
     * Deletes a promo code on AcceptOn.
     *
     * @api public
     *
     * @param string $promoName The name of the promo code to delete.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\PromoCode
     */
    public function deletePromoCode($promoName = "")
    {
        return $this->performDeleteWithObject(
            "/v1/promo_codes/" . $promoName,
            array(),
            "AcceptOn\PromoCode"
        );
    }

    /**
     * Updates a promo code on AcceptOn.
     *
     * @api public
     *
     * @param string $originalName The original name of the promo code.
     * @param mixed[] $params Attributes to set on the promo code.
     * @option string "name" The promo code name, as given to the customer.
     * @option string "promo_type" The type of promo code ("amount", "percentage", or "fixed_price").
     * @option int|float "value" The promo code amount.
     *
     * @throws AcceptOn\Error
     *
     * @return AcceptOn\PromoCode
     */
    public function updatePromoCode($originalName, $params = array())
    {
        return $this->performPutWithObject(
            "/v1/promo_codes/" . $originalName,
            $params,
            "AcceptOn\PromoCode"
        );
    }
}
