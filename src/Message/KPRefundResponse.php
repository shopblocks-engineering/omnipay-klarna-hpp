<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class KPRefundResponse extends AbstractResponse implements ResponseInterface
{
    protected $request;
    protected $response;
    protected $responseBody;

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
            $response['refund_id'] = $this->getRefundId();
        }

        return $response;
    }

    public function getRefundId(): string
    {
        return $this->response->getHeader('Refund-Id') ?? '';
    }

    public function isSuccessful()
    {
        return $this->response->getStatusCode() == 201;
    }
}