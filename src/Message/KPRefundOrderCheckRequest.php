<?php

namespace Omnipay\KlarnaHPP\Message;

class KPRefundOrderCheckRequest extends BaseRequest
{
    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'ordermanagement/v1/orders/' . $this->getOrderRef();
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
        $data['refunded_amount'] = $this->getRefundAmount();
        return $data;
    }

    public function sendData($data): KPRefundOrderCheckResponse
    {
        $response = $this->httpClient->request('GET',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($this->getData())
        );

        return new KPRefundOrderCheckResponse($this, $response, $this->getRefundAmount());
    }
}