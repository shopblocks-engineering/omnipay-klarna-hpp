<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;
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
        $session = $this->createRequest(KPSessionRequest::class, $parameters);
        $response = $session->sendData($parameters);

        $this->setKPToken($response->getData()['session_id']);
        $this->setKPSessionId($response->getData()['client_token']);

        dd(
            $this->getKPToken(),
            $this->getKPSessionId()
        );

        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}