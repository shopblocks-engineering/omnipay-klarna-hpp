<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * Class StartCreditSessionRequest
 */
class StartCreditSessionRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->getBaseData();
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        $base = static::getBaseEndpoint($this->getRegion(), $this->getTestMode());

        return $base . 'payment/v1/sessions';
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return [
            'Content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->getKlarnaUsername() . ':' . $this->getKlarnaPassword())
        ];
    }

    /**
     * @param $data
     *
     * @return StartCreditSessionResponse
     */
    public function sendData($data): StartCreditSessionResponse
    {
        $response = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->getHeaders(),
            json_encode($data)
        );

        return new StartCreditSessionResponse($this, $response);
    }
}