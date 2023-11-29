<?php

namespace Omnipay\KlarnaHPP\Message;

class HPPSessionCheckRequest extends BaseRequest
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
        ];
    }

    public function getData(): array
    {
        return [];
    }

    public function sendData($data): HPPSessionCheckResponse
    {
        $response = $this->httpClient->request('GET',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($this->getData())
        );

        return new HPPSessionCheckResponse($this, $response, $this->getRefundAmount());
    }
}
