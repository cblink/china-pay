<?php


namespace Cblink\ChinaPay\Payment\JsApi;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['jsapi'] = function($app){
            return new Client($app);
        };
    }
}
