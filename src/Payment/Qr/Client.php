<?php

namespace Cblink\ChinaPay\Payment\Qr;

use Cblink\ChinaPay\Payment\BaseClient;
use Cblink\ChinaPay\PaymentConst;

/**
 * Class Client
 * @package Cblink\ChinaPay\Payment\Qr
 */
class Client extends BaseClient
{
    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function order($params)
    {
        $params['instMid'] = PaymentConst::MID_QRPAY;

        return $this->request(PaymentConst::URL_QR_PAY, $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function query($params)
    {
        $params['instMid'] = PaymentConst::MID_QRPAY;

        return $this->request(PaymentConst::URL_QR_PAY_QUERY, $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function refund($params)
    {
        $params['instMid'] = PaymentConst::MID_QRPAY;

        return $this->request(PaymentConst::URL_QR_PAY_REFUND, $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function close($params)
    {
        $params['instMid'] = PaymentConst::MID_QRPAY;

        return $this->request(PaymentConst::URL_QR_PAY_CLOSE, $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function refundQuery($params)
    {
        $params['instMid'] = PaymentConst::MID_QRPAY;

        return $this->request(PaymentConst::URL_QR_PAY_QUERY, $params);
    }
}
