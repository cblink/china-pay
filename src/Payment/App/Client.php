<?php

namespace Cblink\ChinaPay\Payment\App;

use Cblink\ChinaPay\Payment\BaseClient;
use Cblink\ChinaPay\PaymentConst;

class Client extends BaseClient
{
    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function alipay($params)
    {
        $params['instMid'] = PaymentConst::MID_APP;

        return $this->request('/v1/netpay/trade/precreate', $params);
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
        $params['instMid'] = PaymentConst::MID_APP;

        return $this->request('/v1/netpay/uac/app-order', $params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function wx($params)
    {
        $params['instMid'] = PaymentConst::MID_APP;
        $params['tradeType'] = PaymentConst::WX_TRADE_TYPE_APP;

        return $this->request('/v1/netpay/wx/app-pre-order', $params);
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
        $params['instMid'] = PaymentConst::MID_APP;

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
        $params['instMid'] = PaymentConst::MID_APP;

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
        $params['instMid'] = PaymentConst::MID_APP;

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
        $params['instMid'] = PaymentConst::MID_APP;

        return $this->request(PaymentConst::URL_CLOSE, $params);
    }
}
