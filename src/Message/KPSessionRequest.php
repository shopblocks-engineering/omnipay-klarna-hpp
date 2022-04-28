<?php

namespace Omnipay\KlarnaHPP\Message;

/**
 * Class KPSessionRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class KPSessionRequest extends BaseRequest
{
    public function getData(): array
    {
        $data['locale'] = $this->getLocale();
        $data['order_amount'] = $this->getOrderAmount();
        $data['order_tax_amount'] = $this->getOrderTaxAmount();
        $data['order_lines'] = $this->getOrderLines();
        $data['purchase_country'] = $this->getPurchaseCountry();
        $data['purchase_currency'] = $this->getPurchaseCurrency();

        return $data;
    }

    public function getEndpoint()
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'payments/v1/sessions';
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getUsername() . ':' . $this->getPassword()),
        ];
    }

    public function sendData($data): KPSessionResponse
    {
        $response = $this->httpClient->request('POST',
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($data)
        );

        return new KPSessionResponse($this, $response);
    }
}