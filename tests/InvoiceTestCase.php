<?php
namespace Tests;

use Cblink\ChinaPay\Invoice;
use PHPUnit\Framework\TestCase as BaseTestCase;

class InvoiceTestCase extends BaseTestCase
{
    protected $app;

    public function setUp(): void
    {
        $this->app = $this->createChinaPay();
    }

    /**
     * @return Invoice
     */
    public function createChinaPay()
    {
        $config = require dirname(__DIR__).'/config/china-pay-invoice.php';

        return new Invoice($config);
    }

}
