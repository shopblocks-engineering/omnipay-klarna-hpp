<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Class KPSessionResponse
 *
 * @package Omnipay\KlarnaHPP\Message
 */
class KCSessionResponse extends KPSessionResponse
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
     * @return string|null
     */
    public function getClientToken(): ?string
    {
        return $this->responseBody->client_token ?? null;
    }

    /**
     * @return string|null
     */
    public function getSessionId(): ?string
    {
        return $this->responseBody->session_id ?? null;
    }


    /**
     * @return array|null
     */
    public function getPaymentMethodCategories(): ?array
    {
        return $this->responseBody->payment_method_categories ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $response = [];
        if ($this->isSuccessful()) {
            $response['session_id'] = $this->getSessionId();
        }

        return $response;
    }

    public function isSuccessful()
    {
        return in_array($this->response->getStatusCode(), [200, 201]);
    }
}