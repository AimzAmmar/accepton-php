<?php

namespace AcceptOn;

trait Tokenization
{
    public function createToken($params = array())
    {
        return $this->performPostWithObject(
            "/v1/tokens",
            $params,
            "AcceptOn\TransactionToken"
        );
    }
}
