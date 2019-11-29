<?php

namespace Cblink\ChinaPay\Payment\Qr;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{


    public function register(Container $pimple)
    {
        $pimple['qr'] = function($app){
            return new Client($app);
        };
    }
}
