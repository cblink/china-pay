<?php
namespace Tests;

use Carbon\Carbon;
use Cblink\ChinaPay\Payment;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Ramsey\Uuid\Uuid;

class PaymentTestCase extends BaseTestCase
{
    protected $app;

    public function setUp(): void
    {
       $this->app = $this->createChinaPay();
    }

    /**
     * @return Payment
     */
    public function createChinaPay()
    {
        $config = require dirname(__DIR__).'/config/china-pay.php';

        return new Payment($config);
    }


    public function getOrder()
    {
        return new OrderParams([
            'merOrderId' => uniqid(),
            'originalAmount' => 1000,
            'totalAmount' => 1,
            'channel' => '1234',
            'billDate' => Carbon::createFromTimestamp(time(), 'PRC')->format('Y-m-d'),
            'billDesc' => '盒饭',
            'expireTime' => Carbon::createFromTimestamp(time() + 900, 'PRC')->format('Y-m-d H:i:s'),
            'notifyUrl' => 'http://127.0.0.1/demo/notify.php',
            'returnUrl' => 'http://127.0.0.1/demo/payment.php',
            'show_url' => 'http://127.0.0.1/demo/payment.php',
            'subOpenId' => 'xxxxxxx',
            'openId' => 'xxxxxxxxxx',
            'subAppId' => 'xxxxxxxxxxxxxx',

            'sceneType' => 'IOS_WAP',
            'merAppId' => '石方数链',
            'merAppName' => 'http://cblink.net',
            'goods' => [
                [
                    'goodsId' => 666,
                    'goodsName' => '盒饭',
                    'quantity' => 1,
                    'price' => 1
                ]
            ],
            'systemId' => Uuid::uuid4()->getHex()->toString(),
        ]);
    }

}
