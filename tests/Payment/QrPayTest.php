<?php


namespace Tests\Payment;


use Illuminate\Support\Arr;
use Tests\PaymentTestCase;

class QrPayTest extends PaymentTestCase
{

    /**
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function testOrder()
    {
        $params = $this->getOrder()->getQrCodeParams();

        $result = $this->app->qr->order($params);

        $this->assertIsArray($result);

        $this->assertArrayHasKey('billQRCode', $result);

        // cache
        $this->app->cache->set('qr.billNo', $params['billNo']);
        $this->app->cache->set('qr.billDate', $params['billDate']);
        $this->app->cache->set('qr.id', $result['qrCodeId']);
    }

    public function testQuery()
    {
        $result = $this->app->qr->query([
            'billNo' => $this->app->cache->get('qr.billNo'),
            'billDate' =>$this->app->cache->get('qr.billDate'),
        ]);

        $this->assertIsArray($result);
    }

    public function testClose()
    {
        $result = $this->app->qr->close([
            'qrCodeId' => $this->app->cache->get('qr.id'),
        ]);

        $this->assertIsArray($result);
    }

    public function testRefund()
    {
        $params = [
            'billNo' => $this->app->cache->get('qr.billNo'),
            'billDate' =>$this->app->cache->get('qr.billDate'),
            'refundOrderId' => uniqid(),
            'refundAmount' => 1,
            'refundDesc' => '不想要了',
        ];

        $result = $this->app->qr->refund($params);

        $this->assertIsArray($result);

        $this->app->cache->set('qr.refund.id', $params['refundOrderId']);
    }

    public function testRefundQuery()
    {
        $params = [
            'billNo' => $this->app->cache->get('qr.billNo'),
            'billDate' =>$this->app->cache->get('qr.billDate'),
            'refundOrderId' => $this->app->cache->get('qr.refund.id')
        ];

        $result = $this->app->qr->refundQuery($params);

        $this->assertIsArray($result);
    }

}
