<?php


namespace Cblink\ChinaPay\Payment\H5;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['h5'] = function($app){
            return new Client($app);
        };
    }
}
