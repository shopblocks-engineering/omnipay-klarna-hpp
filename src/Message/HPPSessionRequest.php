<?php

namespace Omnipay\KlarnaHPP\Message;

/**
 * Class HPPSessionRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class HPPSessionRequest extends BaseRequest
{
    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'hpp/v1/sessions';
    }

    /**
     * @return string
     */
    public function getSessionURL(): string
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'payments/v1/sessions/' . $this->getKPSessionId();
    }

    public function getData(): array
    {
        $data['payment_session_url'] = $this->getSessionURL();
        $data['merchant_urls'] = $this->getRedirectUrls();

        return $data;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getUsername() . ':' . $this->getPassword()),
        ];
    }

    public function sendData($data): HPPSessionResponse
    {
        $response = $this->httpClient->request('POST',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($this->getData())
        );

        return new HPPSessionResponse($this, $response);
    }
}