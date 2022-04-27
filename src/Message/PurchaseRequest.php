<?php

namespace Omnipay\KlarnaHPP\Message;

/**
 * Class PurchaseRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class PurchaseRequest extends BaseRequest
{
    public function getBaseData() {}

    public function getData() {}

    public function sendData($data)
    {
        return new PurchaseResponse($this, $data);
    }
}