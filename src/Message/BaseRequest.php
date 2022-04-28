<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\KlarnaHPP\Traits\GatewayParameters;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class BaseRequest
 */
abstract class BaseRequest extends AbstractRequest
{
    use GatewayParameters;

    /**
     * @var string[]
     */
    static public $liveApiEndpoints = [
        'europe' => 'https://api.klarna.com/',
        'northAmerica' => 'https://api-na.klarna.com/',
        'oceania' => 'https://api-oc.klarna.com/'
    ];

    /**
     * @var string[]
     */
    static public $testApiEndpoints = [
        'europe' => 'https://api.playground.klarna.com/',
        'northAmerica' => 'https://api-na.playground.klarna.com/',
        'oceania' => 'https://api-oc.playground.klarna.com/'
    ];

    /**
     * Return the base endpoint
     *
     * @param $region
     * @param bool $test
     *
     * @return string
     */
    static public function getBaseEndpoint($region, bool $test = false): string
    {
        if ($test) {
            return static::$testApiEndpoints[$region];
        }

        return static::$liveApiEndpoints[$region];
    }
}