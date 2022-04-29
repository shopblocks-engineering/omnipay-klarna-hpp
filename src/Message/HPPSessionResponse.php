<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class HPPSessionRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class HPPSessionResponse extends AbstractResponse implements RedirectResponseInterface
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

    public function getRedirectUrl(): string
    {
        return $this->responseBody->redirect_url;
    }

    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectData(): ?array
    {
        return $this->getData();
    }

    public function isSuccessful()
    {
        return false;
    }
}