<?php

namespace Omnipay\KlarnaHPP\Message;

/**
 * Class KPSessionRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class KCSessionRequest extends BaseRequest
{
    protected $orderId;


    public function getData(): array
    {
        return [
            'paymentSessionUrl' => static::getBaseEndpoint($this->getRegion(), $this->getTestMode()) . "checkout/v3/orders/$this->orderId",
            'merchant_urls' => $this->getRedirectUrls(),
        ];
    }

    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . "hpp/v1/sessions";
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getUsername() . ':' . $this->getPassword()),
        ];
    }

    public function setOrderId(string $orderId)
    {
        $this->orderId = $orderId;
    }

    public function sendData($data): KCSessionResponse
    {
        $data = $this->getData();
        $response = $this->httpClient->request('POST',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($data)
        );
        return new KCSessionResponse($this, $response);
    }
}