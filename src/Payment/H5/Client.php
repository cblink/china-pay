<?php

namespace Cblink\ChinaPay\Payment\H5;

use Cblink\ChinaPay\Payment\BaseClient;
use Cblink\ChinaPay\PaymentConst;

class Client extends BaseClient
{
    /**
     * @param $params
     * @return string
     */
    public function alipay($params)
    {
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->buildUrl('/v1/netpay/trade/h5-pay', $params);
    }

    /**
     * @param $params
     * @return string
     */
    public function wx($params)
    {
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->buildUrl('/v1/netpay/wxpay/h5-pay', $params);
    }

    /**
     * @param $params
     * @return string
     */
    public function union($params)
    {
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->buildUrl('/v1/netpay/uac/order', $params);
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
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->request(PaymentConst::URL_QUERY, $params);
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
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->request(PaymentConst::URL_REFUND, $params);
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
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->request(PaymentConst::URL_REFUND_QUERY, $params);
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
        $params['instMid'] = PaymentConst::MID_H5;

        return $this->request(PaymentConst::URL_CLOSE, $params);
    }
}
