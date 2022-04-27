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


    public function purchase(array $parameters = [])
    {
        $session = $this->createRequest('\Omnipay\KlarnaPayments\Message\KPSessionRequest', $parameters);

        dd($session);

        return $this->createRequest('\Omnipay\KlarnaPayments\Message\PurchaseRequest', $parameters);
    }
}