<?php
namespace Cblink\ChinaPay\Payment\Base;

use Cblink\ChinaPay\Payment\BaseClient;
use Cblink\ChinaPay\Payment\Exceptions\AccessTokenException;
use Cblink\ChinaPay\PaymentConst;

/**
 * Class AccessToken
 * @package App\Feature\ChinaPay\Payment
 */
class AccessToken extends BaseClient
{
    /**
     * @var string
     */
    protected $cacheKey = 'china-pay.access_token';

    /**
     * @return string
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getAccessToken() : string
    {
        $access_token = $this->app->cache->get($this->cacheKey);

        if(!$access_token){
            $access_token = $this->requestAccessToken();
        }

        return $access_token;
    }

    /**
     * 请求获取access token
     *
     * @return string
     * @throws \Cblink\ChinaPay\Payment\Exceptions\PaymentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function requestAccessToken() : string
    {
        $params = [
            'appId' => $this->app->config->get('app_id'),
            'timestamp' => $this->getTimeString(0, 'YmdHis'),
            'nonce' => uniqid(),
            'signMethod' => 'SHA256',
        ];

        $params['signature'] = $this->getSimpleSignature($params);

        $data = $this->requestRaw('POST', PaymentConst::URL_ACCESS_TOKEN, $params, false);

        if(array_key_exists('accessToken', $data)){
            // 缓存accessToken
            $this->app->cache->set(
                $this->cacheKey,
                $data['accessToken'],
                ($data['expiresIn'] ?? 3600) - 1
            );
            return $data['accessToken'];
        }

        throw new AccessTokenException('get access_token fail!');
    }
}
