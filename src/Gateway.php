<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = [])
    {
        $kpSession = $this->createRequest(KPSessionRequest::class, $parameters);
        $response = $kpSession->sendData($parameters);

        $this->setKPSessionId($response->getData()['session_id']);
        $this->setKPToken($response->getData()['client_token']);

        return $this->createRequest(HPPSessionRequest::class, $parameters);
    }
}