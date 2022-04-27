<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class KPSessionResponse
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class KPSessionResponse extends AbstractResponse implements ResponseInterface
{
    public $request;
    public $response;
    public $responseBody;

    public function __construct(RequestInterface $request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = json_decode($response->getBody()->getContents());
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getData()
    {
        return $this->responseBody;
    }

    public function getCode()
    {
        return $this->response->getStatusCode();
    }

    public function getMessage()
    {
        return "NOT IMPLEMENTED";
    }

    public function isCancelled()
    {
        return false;
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'INSTANCE';
    }

    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Does the response require a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return false;
    }

    public function isSuccessful()
    {
        return $this->getCode() == 200;
    }

    public function getTransactionReference()
    {
        return $this->responseBody->session_id ?? null;
    }

    public function getTransactionId(): ?string
    {
        return $this->data['notavailable'] ?? null;
    }
}