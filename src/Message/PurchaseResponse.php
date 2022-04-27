<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class ResponseRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function getRedirectUrl()
    {
        return '';
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     *
     * @return array
     */
    public function getRedirectData()
    {
        return $this->getData();
    }

    public function isSuccessful()
    {
        return false;
    }

    public function getTransactionReference(): ?int
    {
        return $this->data['transactionID'] ?? null;
    }

    public function getTransactionId(): ?string
    {
        return $this->data['order_ref'] ?? null;
    }
}