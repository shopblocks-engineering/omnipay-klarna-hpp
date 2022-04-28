<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class HPPSessionRequest
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class HPPSessionResponse extends AbstractResponse implements ResponseInterface
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

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];
        if ($this->isSuccessful()) {
            dd($this->responseBody);
        }
        return $response;
    }

    public function isSuccessful()
    {
        return $this->response->getStatusCode() == 200;
    }
}