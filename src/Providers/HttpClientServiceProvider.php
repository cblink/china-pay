<?php
namespace Cblink\ChinaPay\Providers;

use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HttpClientServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['http_client'] = function(){
            return new Client();
        };
    }

}
