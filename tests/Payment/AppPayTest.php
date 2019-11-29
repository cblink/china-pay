<?php

namespace Tests\Payment;

use Tests\PaymentTestCase;

class AppPayTest extends PaymentTestCase
{

    public function testWxOrder()
    {
        // 微信
        $wxParams = $this->getOrder()->getAppParams();
        $result = $this->app->app->wx($wxParams);
        $this->assertIsArray($result);
        $this->app->cache->set('app.wx.id', $wxParams['merOrderId']);
    }

    public function testAlipayOrder()
    {
        // 微信
        $wxParams = $this->getOrder()->getAppParams();
        $result = $this->app->app->alipay($wxParams);
        $this->assertIsArray($result);
        $this->app->cache->set('app.alipay.id', $wxParams['merOrderId']);
    }

    public function testUnionOrder()
    {
        // 微信
        $unionParams = $this->getOrder()->getAppParams();
        $result = $this->app->app->union($unionParams);
        $this->assertIsArray($result);
        $this->app->cache->set('app.union.id', $unionParams['merOrderId']);
    }

    public function testQuery()
    {
        $result = $this->app->app->query([
            'merOrderId' => $this->app->cache->get('app.alipay.id')
        ]);

        $this->assertIsArray($result);
    }

    public function testClose()
    {
        $result = $this->app->app->close([
            'merOrderId' => $this->app->cache->get('app.alipay.id')
        ]);

        $this->assertIsArray($result);
    }

    public function testRefund()
    {
        $params = [
            'merOrderId' => $this->app->cache->get('app.alipay.id'),
            'refundOrderId' => uniqid(),
            'refundAmount' => 1
        ];

        $result = $this->app->app->refund($params);

        $this->assertIsArray($result);

        $this->app->cache->set('app.refund.id', $params['refundOrderId']);
    }

    public function testRefundQuery()
    {
        $result = $this->app->app->refundQuery([
            'merOrderId' => $this->app->cache->get('app.refund.id')
        ]);

        $this->assertIsArray($result);
    }

}
