<?php

namespace Cblink\ChinaPay;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Pimple\Container;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Psr16Cache;

/**
 * Class Application
 * @package Cblink\ChinaPay\Payment
 * @property Repository         $config         配置
 * @property LoggerInterface    $logger         日志
 * @property Psr16Cache         $cache          缓存
 * @property Client             $http_client    请求组件
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $configure;

    protected $providers = [];

    public function __construct(array $configure = [])
    {
        $this->bootstrap($configure);
        $this->bootstrapProviders();
        parent::__construct();
    }

    /**
     *
     */
    public function bootstrapProviders()
    {
        $providers = array_merge([
            Providers\ConfigServiceProvider::class,
            Providers\LogServiceProvider::class,
            Providers\CacheServiceProvider::class,
            Providers\HttpClientServiceProvider::class,
        ], $this->providers);

        foreach ($providers as $provider){
            parent::register(new $provider);
        }
    }

    /**
     * @param $configure
     */
    public function bootstrap($configure)
    {
        $this->configure = $configure;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->configure;
    }

    /**
     * @param $id
     * @param $value
     */
    public function rebind($id, $value)
    {
        $this->offsetUnset($id);
        $this->offsetSet($id, $value);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

}
