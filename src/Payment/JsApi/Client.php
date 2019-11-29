<?php

namespace Cblink\ChinaPay\Payment\JsApi;

use Cblink\ChinaPay\PaymentConst;
use Cblink\ChinaPay\Payment\BaseClient;

/**
 * Class Client
 * @package Cblink\ChinaPay\Payment\JsApi
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
    public function wx($params)
    {
        $params['instMid'] = PaymentConst::MID_YUEDAN;
        $params['tradeType'] = PaymentConst::WX_TRADE_TYPE_JSAPI;

        return $this->request('/v1/netpay/wx/unified-order', $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function alipay($params)
    {
        $params['instMid'] = PaymentConst::MID_YUEDAN;

        return $this->request('/v1/netpay/trade/create', $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function union($params)
    {
        $params['instMid'] = PaymentConst::MID_YUEDAN;

        return $this->request('/v1/netpay/acp/js-pay', $params);
    }

    /**
     * @param $params
     * @return string
     */
    public function order($params)
    {
        $params['instMid'] = PaymentConst::MID_YUEDAN;

        return $this->buildUrl(PaymentConst::URL_WEB_PAY, $params);
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
        $params['instMid'] = PaymentConst::MID_YUEDAN;

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
        $params['instMid'] = PaymentConst::MID_YUEDAN;

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
        $params['instMid'] = PaymentConst::MID_YUEDAN;

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
        $params['instMid'] = PaymentConst::MID_YUEDAN;

        return $this->request(PaymentConst::URL_CLOSE, $params);
    }
}
