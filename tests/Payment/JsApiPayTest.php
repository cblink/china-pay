<?php


namespace Tests\Payment;


use Tests\PaymentTestCase;

class JsApiPayTest extends PaymentTestCase
{

    public function testUnion()
    {
        // 银联
        $unionParanms = $this->getOrder()->getJsApiParams();
        $unionResult = $this->app->jsapi->union($unionParanms);
        $this->assertIsArray($unionResult);
        $this->app->cache->set('js.union.id', $unionParanms['merOrderId']);
    }

    public function testWxOrder()
    {
        // 微信
        $wxParams = $this->getOrder()->getJsApiParams();
        $result = $this->app->jsapi->wx($wxParams);
        $this->assertIsArray($result);
        $this->app->cache->set('js.wx.id', $wxParams['merOrderId']);
    }

    public function testAlipay()
    {
        // 支付宝
        $alipayParams = $this->getOrder()->getJsApiParams();
        $result = $this->app->jsapi->alipay($alipayParams);
        $this->assertIsArray($result);
        $this->app->cache->set('js.alipay.id', $alipayParams['merOrderId']);
    }

    public function testQuery()
    {
        $result = $this->app->jsapi->query([
            'merOrderId' => $this->app->cache->get('js.wx.id')
        ]);

        $this->assertIsArray($result);
    }

    public function testClose()
    {
        $result = $this->app->jsapi->close([
            'merOrderId' => $this->app->cache->get('js.wx.id')
        ]);

        $this->assertIsArray($result);
    }

    public function testRefund()
    {
        $params = [
            'merOrderId' => $this->app->cache->get('js.wx.id'),
            'refundOrderId' => uniqid(),
            'refundAmount' => 1
        ];

        $result = $this->app->jsapi->refund($params);

        $this->assertIsArray($result);

        $this->app->cache->set('js.refund.id', $params['merOrderId']);
    }

    public function testRefundQuery()
    {
        $result = $this->app->jsapi->refundQuery([
            'merOrderId' => $this->app->cache->get('js.refund.id')
        ]);

        $this->assertIsArray($result);
    }
}
