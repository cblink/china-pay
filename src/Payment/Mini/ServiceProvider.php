<?php


namespace Cblink\ChinaPay\Payment\Mini;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['mini'] = function($app){
            return new Client($app);
        };
    }
}
