<?php
namespace Cblink\ChinaPay\Providers;

use Illuminate\Config\Repository;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['config'] = function($pimple){
            return new Repository($pimple->getConfig());
        };
    }

}
