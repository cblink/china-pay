<?php

namespace Cblink\ChinaPay\Payment\Base;

use InvalidArgumentException;
use Cblink\ChinaPay\Payment\BaseClient;

/**
 * Class Base
 * @package Cblink\ChinaPay\Payment\Base
 */
class Base extends BaseClient
{
    /**
     * @return string
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getAccessToken()
    {
        return $this->app->access_token->getAccessToken();
    }

    /**
     *
     *
     * @param $type
     * @param $platform
     * @param $params
     * @return array|string
     */
    public function order($type, $platform, array $params)
    {
        $instance = $this->getInstance($type);

        if (!method_exists($instance, $platform)) {
            throw new InvalidArgumentException(sprintf('%s is not defined', $platform));
        }

        return $instance->{$platform}($params);
    }

    /**
     * @param $type
     * @param $params
     * @return array
     */
    public function query($type, $params)
    {
        return $this->getInstance($type)->query($params);
    }

    /**
     * @param $type
     * @param $params
     * @return array
     */
    public function close($type, $params)
    {
        return $this->getInstance($type)->close($params);
    }

    /**
     * @param $type
     * @param $params
     * @return array
     */
    public function refund($type, $params)
    {
        return $this->getInstance($type)->refund($params);
    }

    /**
     * @param $type
     * @param $params
     * @return array
     */
    public function refundQuery($type, $params)
    {
        return $this->getInstance($type)->refundQuery($params);
    }

    /**
     * @param $type
     * @return BaseClient
     */
    protected function getInstance($type)
    {
        return $this->app->{$type};
    }

}
