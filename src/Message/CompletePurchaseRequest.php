<?php

namespace Omnipay\KlarnaHPP\Message;

/**
 * Class CompletePurchaseRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class CompletePurchaseRequest extends BaseRequest
{
    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'hpp/v1/sessions/' . $this->getSessionId();
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getUsername() . ':' . $this->getPassword()),
            'Cache-Control' => 'no-cache'
        ];
    }

    public function getData(): array
    {
        return [];
    }

    /**
     * Check that the data has retained its correct signature,
     * before passing it on to the response.
     *
     * @param array $data
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('GET',
            $this->getEndpoint(),
            $this->getHeaders()
        );

        return new CompletePurchaseResponse($this, $response);
    }
}