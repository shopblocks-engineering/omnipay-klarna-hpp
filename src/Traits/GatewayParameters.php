<?php

namespace Omnipay\KlarnaHPP\Traits;

/**
 * Trait GatewayParameters
 */
trait GatewayParameters
{
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
    public function getUsername()
    {
        return $this->getParameter('klarna_username');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setUsername($value)
    {
        return $this->setParameter('klarna_username', $value);
    }

    public function setOrderMode(string $value)
    {
        return $this->setParameter('order_mode', $value);
    }

    public function getOrderMode(): string
    {
        return $this->getParameter('order_mode');
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->getParameter('klarna_password');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setPassword($value)
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

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->getParameter('session_id');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setSessionId($value)
    {
        return $this->setParameter('session_id', $value);
    }

    /**
     * @return string
     */
    public function getOrderRef(): string
    {
        return $this->getParameter('order_ref');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setOrderRef($value)
    {
        return $this->setParameter('order_ref', $value);
    }

    /**
     * @return string
     */
    public function getKPSessionId(): string
    {
        return $this->getParameter('kp_session_id');
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setKPSessionId($value)
    {
        return $this->setParameter('kp_session_id', $value);
    }

    /**
     * @return string
     */
    public function getKPToken(): string
    {
        return $this->getParameter('kp_token');
    }

    /**
     * @return mixed
     */
    public function setKPToken(string $value)
    {
        return $this->setParameter('kp_token', $value);
    }

    public function setRedirectUrls(array $value)
    {
        return $this->setParameter('redirect_urls', $value);
    }

    public function getRedirectUrls(): array
    {
        return $this->getParameter('redirect_urls');
    }

    public function setBillingAddress(array $value)
    {
        return $this->setParameter('billing_address', $value);
    }

    public function getBillingAddress(): array
    {
        return $this->getParameter('billing_address');
    }

    public function setDeliveryAddress(array $value)
    {
        return $this->setParameter('delivery_address', $value);
    }

    public function getDeliveryAddress(): ?array
    {
        return $this->getParameter('delivery_address');
    }

    public function hasDeliveryAddress(): bool
    {
        return (bool) !empty($this->getDeliveryAddress);
    }

    public function setMerchantReference1(string $value)
    {
        return $this->setParameter('merchant_reference1', $value);
    }

    public function getMerchantReference1(): string
    {
        return $this->getParameter('merchant_reference1');
    }

    public function setMerchantReference2(string $value)
    {
        return $this->setParameter('merchant_reference2', $value);
    }

    public function getMerchantReference2(): string
    {
        return $this->getParameter('merchant_reference2');
    }

    public function hasOptions(): bool
    {
        return (bool) !empty($this->getOptions());
    }

    public function getOptions(): ?array
    {
        return $this->getParameter('options');
    }

    public function setOptions(array $value)
    {
        return $this->setParameter('options', $value);
    }

    public function setHppUrl(string $value)
    {
        return $this->setParameter('hpp_url', $value);
    }

    public function getHppUrl(): string
    {
        return $this->getParameter('hpp_url');
    }
}