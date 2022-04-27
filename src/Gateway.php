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
    public function startCreditSession(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\KlarnaPayments\Message\StartCreditSessionRequest', $parameters);
    }
}