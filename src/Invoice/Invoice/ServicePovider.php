<?php
namespace Cblink\ChinaPay\Invoice\Invoice;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class InvoiceServiceProvider
 * @package App\Feature\ChinaPay\Providers
 */
class ServicePovider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['invoice'] = function($app){
            return new Client($app);
        };
    }

}
