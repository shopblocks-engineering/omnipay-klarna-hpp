<?php

namespace Omnipay\KlarnaHPP\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class KPRefundOrderCheckResponse extends AbstractResponse implements ResponseInterface
{
    protected $request;
    protected $response;
    protected $responseBody;

    public function __construct(RequestInterface $request, $response, $refundAmount)
    {
        $this->request = $request;
        $this->response = $response;
        $this->responseBody = json_decode($response->getBody()->getContents(), true);
        $this->refundAmount = $refundAmount;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->responseBody;
    }

    public function isSuccessful()
    {
        $klarnaOrder = $this->responseBody;

        if ($this->response->getStatusCode() != 200) {
            return false;
        }

        $refundedAmount = 0;
        if (!empty($klarnaOrder) && !empty($klarnaOrder['refunds'])) {
            foreach ($klarnaOrder['refunds'] as $refund) {
                $refundedAmount += $refund['refunded_amount'];
            }
        }
        $remainingAmount = $klarnaOrder['captured_amount'] - $refundedAmount;

        // Order has already been fully refunded
        if ($remainingAmount == 0) {
            return [
                'refundAmount' => 0
            ];
        }

        // Handle if the amount to be refunded is greater than the amount remaining
        if ($this->refundAmount > $remainingAmount) {
            return [
                'error_code' => 'REFUND_NOT_ALLOWED',
                'error_message' => 'Unable to continue with refund as the amount remaining on the order in Klarna is less than the amount you are trying to refund. Please check your order in Klarna before trying again.'
            ];
        }

        return $this->response->getStatusCode() == 200;
    }
}
