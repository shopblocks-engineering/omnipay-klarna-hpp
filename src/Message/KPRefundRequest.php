<?php

namespace Omnipay\KlarnaHPP\Message;

class KPRefundRequest extends BaseRequest
{
    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'ordermanagement/v1/orders/' . $this->getOrderRef() . '/refunds';
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
        $data['description'] = $this->getRefundReason();
        return $data;
    }

    public function sendData($data): KPRefundResponse
    {
        $response = $this->httpClient->request('POST',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($this->getData())
        );

        return new KPRefundResponse($this, $response);
    }
}