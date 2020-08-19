<?php

namespace Cblink\ChinaPay;

use Closure;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class Notify
{
    /**
     * @var Payment
     */
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function handle(Closure $closure)
    {
        parse_str($this->app->request->getContent(), $data);

        if (!$this->validate($data)) {
            throw new InvalidArgumentException();
        }

        $result = $closure($data);

        return new Response($result ? 'SUCCESS' : 'FAILED');
    }

    /**
     * 验证签名
     *
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        if (!isset($data['sign'])) {
            return false;
        }

        $sign = $data['sign'];
        unset($data['sign']);

        ksort($data);

        $signStr = urldecode(http_build_query($data)) . $this->app->config->get('secret');

        return $sign == strtoupper(md5($signStr));
    }
}
