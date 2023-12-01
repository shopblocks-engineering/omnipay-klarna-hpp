<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class HPPSessionCheckResponse extends AbstractResponse implements ResponseInterface
{
    protected $request;
    protected $response;
    protected $responseBody;

    public function __construct(RequestInterface $request, $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->responseBody;
    }

    public function isSuccessful()
    {
        return $this->response->getStatusCode() == 200;
    }
}
