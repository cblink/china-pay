<?php


namespace Tests\Payment;


use Tests\PaymentTestCase;

class AccessTokenTest extends PaymentTestCase
{
    public function testExample()
    {
        $this->assertIsString($this->app->getAccessToken());
    }
}
