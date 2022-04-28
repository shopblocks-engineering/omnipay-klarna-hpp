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
        $data['billing_address'] = $this->getBillingAddress();

        if ($this->hasDeliveryAddress()) {
            $data['shipping_address'] = $this->getDeliveryAddress();
        }

        $data['merchant_reference1'] = $this->getMerchantReference1();
        $data['merchant_reference2'] = $this->getMerchantReference2();

        if ($this->hasOptions()) {
            $data['options'] = $this->getOptions();
        }

        $data['order_amount'] = $this->getOrderAmount();
        $data['order_lines'] = $this->getOrderLines();
        $data['order_tax_amount'] = $this->getOrderTaxAmount();
        $data['purchase_country'] = $this->getPurchaseCountry();
        $data['purchase_currency'] = $this->getPurchaseCurrency();
        $data['locale'] = $this->getLocale();

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
            json_encode($this->getData())
        );

        return new KPSessionResponse($this, $response);
    }
}