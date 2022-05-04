<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\KlarnaHPP\Message\CompletePurchaseRequest;
use Omnipay\KlarnaHPP\Message\HPPSessionRequest;
use Omnipay\KlarnaHPP\Message\KPSessionRequest;
use Omnipay\KlarnaHPP\Traits\GatewayParameters;

/**
 * Class Gateway
 */
class Gateway extends AbstractGateway
{
    use GatewayParameters;

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
            'testMode' => false
        ];
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        $kpSession = $this->createRequest(KPSessionRequest::class, $parameters);
        $response = $kpSession->sendData($parameters);

        $this->setKPSessionId($response->getData()['session_id']);
        $this->setKPToken($response->getData()['client_token']);

        return $this->createRequest(HPPSessionRequest::class, $parameters);
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
}