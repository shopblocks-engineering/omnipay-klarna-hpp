<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;
use Omnipay\KlarnaHPP\Message\HPPSessionRequest;
use Omnipay\KlarnaHPP\Message\KPSessionRequest;
use Omnipay\KlarnaHPP\Message\PurchaseRequest;
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
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $parameters = [])
    {
        $kpSession = $this->createRequest(KPSessionRequest::class, $parameters);
        $response = $kpSession->sendData($parameters);

        $this->setKPSessionId($response->getData()['session_id']);
        $this->setKPToken($response->getData()['client_token']);

        $hppSession = $this->createRequest(HPPSessionRequest::class, $parameters);
        $response = $hppSession->sendData($parameters);

        dd($response->getData());

        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}