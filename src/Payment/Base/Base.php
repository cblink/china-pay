<?php

namespace Cblink\ChinaPay\Payment\Base;

use Cblink\ChinaPay\Payment\BaseClient;

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
}
