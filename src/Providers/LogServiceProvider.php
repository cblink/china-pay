<?php
namespace Cblink\ChinaPay\Providers;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as Monolog;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class LogServiceProvider implements ServiceProviderInterface
{
    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug' => Monolog::DEBUG,
        'info' => Monolog::INFO,
        'notice' => Monolog::NOTICE,
        'warning' => Monolog::WARNING,
        'error' => Monolog::ERROR,
        'critical' => Monolog::CRITICAL,
        'alert' => Monolog::ALERT,
        'emergency' => Monolog::EMERGENCY,
    ];

    public function register(Container $pimple)
    {
        $pimple['logger'] = function($pimple){
            return $this->createDailyDriver(
                $this->getLogConfig($pimple)
            );
        };
    }

    /**
     * Create an instance of the daily file log driver.
     *
     * @param array $config
     *
     * @return \Psr\Log\LoggerInterface
     */
    protected function createDailyDriver($config)
    {
        return new Monolog($config['name'], [
            new RotatingFileHandler(
                $config['path'], $config['days'] ?? 7, $this->level($config)
            ),
        ]);
    }

    /**
     * @param $pimple
     * @return array
     */
    protected function getLogConfig($pimple)
    {
        if($pimple->config->get('log', [])){
            return $pimple->config->get('log');
        }

        return [
            'log' => [
                'name' => 'chant-pay',
                'level' => 'debug',
                'days' => 7,
                'path' => __DIR__.'/logs/'
            ]
        ];
    }

    /**
     * Parse the string level into a Monolog constant.
     *
     * @param array $config
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    protected function level(array $config)
    {
        $level = $config['level'] ?? 'debug';

        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        }

        throw new \InvalidArgumentException('Invalid log level.');
    }
}
