<?php

namespace Tests\Payment;

use Tests\PaymentTestCase;

class H5PayTest  extends PaymentTestCase
{

    public function testUnionOrder()
    {
        // union

        $unionParams = $this->getOrder()->getH5Params();

        $union = $this->app->h5->union($unionParams);

        $this->assertTrue((bool) filter_var($union, FILTER_VALIDATE_URL));

        var_dump($union);

        $this->app->cache->set('h5.union.id', $unionParams['merOrderId']);
    }

    public function testWxOrder()
    {
        // wx
        $WXParams = $this->getOrder()->getH5Params();

        $wx = $this->app->h5->wx($WXParams);

        $this->assertTrue((bool) filter_var($wx, FILTER_VALIDATE_URL));

        var_dump($wx);

        $this->app->cache->set('h5.wx.id', $WXParams['merOrderId']);
    }

    public function testAlipayOrder()
    {
        $alipayParams = $this->getOrder()->getH5Params();

        // alipay
        $alipay = $this->app->h5->alipay($alipayParams);

        $this->assertTrue((bool) filter_var($alipay, FILTER_VALIDATE_URL));

        var_dump($alipay);

        $this->app->cache->set('h5.alipay.id', $alipayParams['merOrderId']);
    }

    public function testClose()
    {
        $result = $this->app->h5->close([
            'merOrderId' => $this->app->cache->get('h5.alipay.id')
        ]);

        $this->assertIsArray($result);
    }


    public function testQuery()
    {
        $result = $this->app->h5->query([
            'merOrderId' => $this->app->cache->get('h5.alipay.id')
        ]);

        $this->assertIsArray($result);
    }

    public function testRefund()
    {
        $params = [
            'merOrderId' => $this->app->cache->get('h5.alipay.id'),
            'refundAmount' => 1,
            'refundOrderId' => uniqid()
        ];

        $result = $this->app->h5->refund($params);

        $this->assertIsArray($result);

        $this->app->cache->set('h5.refund.id', $params['refundOrderId']);
    }

    public function testRefundQuery()
    {
        $result = $this->app->h5->refundQuery([
            'merOrderId' => $this->app->cache->get('h5.refund.id'),
        ]);

        $this->assertIsArray($result);
    }

}

