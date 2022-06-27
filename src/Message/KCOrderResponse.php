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
class KCOrderResponse extends AbstractResponse implements ResponseInterface
{
    protected $request;
    protected $response;
    protected $responseBody;

    public function __construct(RequestInterface $request, $response)
    {
        parent::__construct($request, $response);
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return string|null
     */
    public function getClientToken(): ?string
    {
        return $this->responseBody->client_token ?? null;
    }

    public function getData(): array
    {
        return $this->responseBody;
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

    public function isSuccessful(): bool
    {
        return in_array($this->response->getStatusCode(), [200, 201]);
    }
}