<?php


namespace Tests\Payment;


use Tests\PaymentTestCase;

class MiniPayTest extends PaymentTestCase
{
    public function testWxOrder()
    {
        $params = $this->getOrder()->getMiniParams();

        $result = $this->app->mini->wx($params);

        $this->assertIsArray($result);
    }

    public function testAlipayOrder()
    {
        $params = $this->getOrder()->getMiniParams();

        $result = $this->app->mini->alipay($params);

        $this->assertIsArray($result);
    }
}
