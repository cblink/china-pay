<?php
namespace Cblink\ChinaPay;

use Cblink\ChinaPay\Invoice\Invoice\Client;

/**
 * Class ChinaPay
 *
 * @property Client            $invoice        发票
 *
 * @package App\Feature\ChinaPay
 */
class Invoice extends Application
{
    protected $providers = [
        Invoice\Invoice\ServicePovider::class,
    ];
}
