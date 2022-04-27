<?php

namespace Omnipay\KlarnaHPP\Traits;

/**
 * Trait GatewayParameters
 */
trait GatewayParameters
{
    public $baseData = [
        'locale',
        'order_amount',
        'order_tax_amount',
        'order_lines',
        'purchase_country',
        'purchase_currency'
    ];

    /**
     * @return array
     */
    protected function getBaseData(): array
    {
        $data = [];

        foreach ($this->baseData as $key) {
            $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            $data[$key] = $this->$method;
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    /**
     * @return mixed
     */
    public function getOrderAmount()
    {
        return $this->getParameter('order_amount');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setOrderAmount($value)
    {
        return $this->setParameter('order_amount', $value);
    }

    /**
     * @return mixed
     */
    public function getOrderLines()
    {
        return $this->getParameter('order_lines');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setOrderLines($value)
    {
        return $this->setParameter('order_lines', $value);
    }

    /**
     * @return mixed
     */
    public function getPurchaseCountry()
    {
        return $this->getParameter('purchase_country');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setPurchaseCountry($value)
    {
        return $this->setParameter('purchase_country', $value);
    }

    /**
     * @return mixed
     */
    public function getPurchaseCurrency()
    {
        return $this->getParameter('purchase_currency');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setPurchaseCurrency($value)
    {
        return $this->setParameter('purchase_currency', $value);
    }

    /**
     * @return mixed
     */
    public function getAuthorizationToken()
    {
        return $this->getParameter('authorization_token');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setAuthorizationToken($value)
    {
        return $this->setParameter('authorization_token', $value);
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->getParameter('region');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setRegion($value)
    {
        return $this->setParameter('region', $value);
    }

    /**
     * @return bool
     */
    public function getTestMode(): bool
    {
        return (bool) $this->getParameter('testMode');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    /**
     * @return mixed
     */
    public function getKlarnaUsername()
    {
        return $this->getParameter('klarna_username');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setKlarnaUsername($value)
    {
        return $this->setParameter('klarna_username', $value);
    }

    /**
     * @return mixed
     */
    public function getKlarnaPassword()
    {
        return $this->getParameter('klarna_password');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setKlarnaPassword($value)
    {
        return $this->setParameter('klarna_password', $value);
    }

    /**
     * @return mixed
     */
    public function getOrderTaxAmount()
    {
        return $this->getParameter('order_tax_amount');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setOrderTaxAmount($value)
    {
        return $this->setParameter('order_tax_amount', $value);
    }
}