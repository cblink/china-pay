<?php
namespace Cblink\ChinaPay\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

/**
 * Class CacheServiceProvider
 * @package Cblink\ChinaPay\Providers
 */
class CacheServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['cache'] = function($app){
            return new Psr16Cache(new FilesystemAdapter('china-pay', 1500));
        };
    }

}

