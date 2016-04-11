<?php

namespace AcceptOn\API;

trait Tokenization
{
    /**
     * Creates a transaction token on AcceptOn.
     *
     * @api public
     *
     * @param mixed[] $params Attributes to set on the transaction token.
     * @option int "amount" The amount in cents of the transaction.
     * @option int|null "application_fee" The application fee in cents to pass to the processor.
     * @option string|null "currency" The currency to charge in (default: "usd").
     * @option string|null "description" A description of the transaction.
     * @option string|null "merchant_paypal_account" The merchant's PayPal account when you want
     *     to pay a merchant instead of yourself. Can be used with an application fee.
     */
    public function createToken($params = array())
    {
        return $this->performPostWithObject(
            "/v1/tokens",
            $params,
            "AcceptOn\TransactionToken"
        );
    }
}
