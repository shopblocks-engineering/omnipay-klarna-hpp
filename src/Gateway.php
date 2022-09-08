<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\KlarnaHPP\Message\CompletePurchaseRequest;
use Omnipay\KlarnaHPP\Message\HPPSessionRequest;
use Omnipay\KlarnaHPP\Message\KCOrderRequest;
use Omnipay\KlarnaHPP\Message\KCOrderResponse;
use Omnipay\KlarnaHPP\Message\KCSessionRequest;
use Omnipay\KlarnaHPP\Message\KCSessionResponse;
use Omnipay\KlarnaHPP\Message\KPRefundRequest;
use Omnipay\KlarnaHPP\Message\KPSessionRequest;
use Omnipay\KlarnaHPP\Message\KPSessionResponse;
use Omnipay\KlarnaHPP\Traits\GatewayParameters;
use PHPUnit\Framework\Constraint\LogicalAnd;

/**
 * Class Gateway
 */
class Gateway extends AbstractGateway
{
    use GatewayParameters;

    protected $versions = [
        'session' => [
            'request' => [
                'checkout' => KCSessionRequest::class,
                'payments' => KPSessionRequest::class,
            ],
            'response' => [
                'checkout' => KCSessionResponse::class,
                'payments' => KPSessionResponse::class,
            ]
        ]
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Klarna HPP';
    }

    /**
     * Get the gateway parameters
     *
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'username' => '',
            'password' => '',
            'testMode' => false,
        ];
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        $kpSession = $this->createRequest($this->versions['session']['request'][$this->getVersion()], $parameters);

        if ($this->getVersion() === "checkout") {
            $request = $this->createRequest(KCOrderRequest::class, $parameters);
            /** @var KCOrderResponse $response */
            $response = $request->sendData($parameters);
            if (!$response->isSuccessful()) {
                throw new RuntimeException("Unable to generate Order ID for Session");
            }
            $responseData = $response->getData();
            $kpSession->setOrderId($responseData['order_id']);
            $parameters = array_merge($parameters, $kpSession->getData());
        }

        $response = $kpSession->sendData($parameters);
        $responseData = array_merge($parameters, $response->getData());
        /** @var HPPSessionRequest $hppSessionRequest */
        $hppSessionRequest = $this->createRequest(HPPSessionRequest::class, $parameters);
        $hppSessionRequest->setPaymentSessionUrl($responseData['paymentSessionUrl']);

        return $hppSessionRequest;
    }

    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    /**
     * Authorize will pass the request to purchase as the process is the same until after the checkout process
     *
     * @param array $options
     *
     * @return RequestInterface
     */
    public function authorize(array $options = array()): RequestInterface
    {
        return $this->purchase($options);
    }

    public function completeAuthorize(array $options = array()): RequestInterface
    {
        // TODO: Implement completeAuthorize() method.
    }

    public function refund(array $parameters = []): RequestInterface
    {
        return $this->createRequest(KPRefundRequest::class, $parameters);
    }
}