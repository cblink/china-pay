<?php
namespace Tests\Invoice;

use Cblink\ChinaPay\InvoiceConst;
use Tests\InvoiceTestCase;

/**
 * Class InvoiceTest
 * @package Cblink\ChinaPay\Tests\Unit
 */
class InvoiceTest extends InvoiceTestCase
{
    public function testExample()
    {
        $payload = [
            'merOrderDate' => date('Ymd'),
            'merOrderId' => uniqid(),
            'buyerName' => '深圳某某公司',
            'buyerTaxCode' => '91440300124567890A',
            'amount' => '5000',
            'notifyUrl' => 'http://www.baidu.com',
            'goodsDetail' => [
                [
                    'index' => 1,
                    'attribute' => InvoiceConst::INVOICE_GOOD_ATTRIBUTE_NORMAL,
                    'name' => 'Iphone 11',
                    'sn' => '1234567899876543210',
                    'taxRate' => 8,
                    'priceIncludingTax' => 50,
                    'quantity' => 1
                ]
            ]
        ];

        // 闯进发票
        $this->assertIsArray($this->app->invoice->issue($payload));

        // 查询开票
        $this->assertIsArray($this->app->invoice->query([
            'merOrderId' => $payload['merOrderId'],
            'merOrderDate' => $payload['merOrderDate']
        ]));
    }
}
