<?php

namespace Cblink\ChinaPay\Payment\Base;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['base'] = function($app){
            return new Base($app);
        };

        $pimple['access_token'] = function($app){
            return new AccessToken($app);
        };
    }

}
