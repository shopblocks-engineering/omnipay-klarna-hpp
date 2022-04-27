<?php

namespace Omnipay\KlarnaHPP;

use Omnipay\Common\AbstractGateway;

/**
 * Class Gateway
 */
class Gateway extends AbstractGateway
{
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
     * Start a new credit session
     */
    public function startKPSession(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\KlarnaPayments\Message\KPSessionRequest', $parameters);
    }

    public function purchase(array $parameters = [])
    {
        dd($parameters);

        return $this->createRequest('\Omnipay\KlarnaPayments\Message\PurchaseRequest', $parameters);
    }
}