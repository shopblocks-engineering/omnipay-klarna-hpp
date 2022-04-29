<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class CompletePurchaseRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public $request;
    public $response;
    public $responseBody;

    public function __construct(RequestInterface $request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = json_decode($response->getBody()->getContents());
    }

    public function isSuccessful(): bool
    {
        if ($this->responseBody->status === 'COMPLETED') {
            return true;
        }

        return false;
    }

    public function getTransactionReference(): ?string
    {
        return $this->responseBody->order_id ?? ($this->responseBody->klarna_reference ?? ($this->responseBody->authorization_token ?? null));
    }
}