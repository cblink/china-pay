<?php

namespace Cblink\ChinaPay\Payment;

use Carbon\Carbon;
use Cblink\ChinaPay\Payment;
use GuzzleHttp\Exception\GuzzleException;
use Cblink\ChinaPay\Payment\Exceptions\PaymentException;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class BaseClient
 * @package App\Feature\ChinaPay\Payment
 */
abstract class BaseClient
{
    /**
     * @var Payment
     */
    protected $app;

    public function __construct(Payment $payment)
    {
        $this->app = $payment;
    }

    /**
     * @param string $uri
     * @param array $params
     * @param string $method
     * @return array
     * @throws InvalidArgumentException|Payment\Exceptions\PaymentException|GuzzleException
     */
    protected function request(string $uri,array $params,string $method = 'POST') : array
    {
        $params = array_merge([
            'requestTimestamp' => $this->getTimeString(),
            'mid' => $this->app->config->get('mid'),
            'tid' => $this->app->config->get('tid'),
        ], $params);

        if(array_key_exists('merOrderId',$params)){
            $params['merOrderId'] = $this->app->config->get('order_src') . $params['merOrderId'];
        }

        if(array_key_exists('billNo',$params)){
            $params['billNo'] = $this->app->config->get('order_src') . $params['billNo'];
        }

        if (array_key_exists('refundOrderId', $params)) {
            $params['refundOrderId'] = $this->app->config->get('order_src') . $params['refundOrderId'];
        }

        return $this->requestRaw($method, $uri, $params);
    }

    /**
     * @param int $time
     * @param string $format
     * @return string
     */
    protected function getTimeString($time = 0, $format = 'Y-m-d H:i:s')
    {
        return Carbon::createFromTimestamp(time() + $time, 'PRC')->format($format);
    }

    /**
     * 发起请求
     *
     * @param $method
     * @param $uri
     * @param $params
     * @param bool $auth
     * @return array
     * @throws InvalidArgumentException|Payment\Exceptions\PaymentException|GuzzleException
     */
    protected function requestRaw(string $method, string $uri, array $params, bool $auth = true) : array
    {
        // 如果是post请求参数使用json
        $argsType = $method == 'POST' ? 'json' : 'query';

        $options = ['http_errors' => false, 'verify' => false, $argsType => $params];

        // 是否使用认证
        if($auth){
            $sign = $this->app->config->get('sign_type') == 'token '?
                $this->getAccessTokenSign() : $this->getBodySign($params);

            $options['headers'] = ['Authorization' => $sign];
        }

        $res = $this->app->http_client->request($method, $this->url($uri), $options);

        $content = $res->getBody()->getContents();

        $this->logRequest([$method, $this->url($uri), $options], $res->getStatusCode(), $content);

        return $this->getResponse($res, $content);
    }

    /**
     * @param $params
     * @param $statusCode
     * @param $content
     */
    protected function logRequest($params, $statusCode, $content)
    {
        // 如果开启调试，每次请求结果都记录到日志
        if(!$this->app->config->get('debug')){
            return;
        }

        $this->app->logger->info("request result", [
            'statusCode' => $statusCode,
            'data' => $content,
            'params' => $params
        ]);
    }

    /**
     * @param $res
     * @param $content
     * @return mixed
     * @throws
     */
    protected function getResponse($res, $content) :array
    {
        $data = json_decode($content, true);

        if($res->getStatusCode() != 200){
            throw new PaymentException(sprintf('REQUEST FAIL：%s，CODE：%s', $content, $res->getStatusCode()));
        }

        return $data;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function isSuccess($data)
    {
        // 判断是否成功
        return !(isset($data['errCode']) && ($data['errCode'] === "SUCCESS" || $data['errCode'] === "0000"));
    }

    /**
     * 生成Url
     *
     * @param $uri
     * @param array $params
     * @return string
     */
    protected function buildUrl($uri, array $params) : string
    {
        $params = array_merge($params, [
            'requestTimestamp' => date('Y-m-d H:i:s'),
            'mid' => $this->app->config->get('mid'),
            'tid' => $this->app->config->get('tid')
        ]);

        if(array_key_exists('merOrderId',$params)){
            $params['merOrderId'] = $this->app->config->get('order_src') . $params['merOrderId'];
        }

        $content = json_encode($params);
        $timestamp = date('YmdHis');
        $nonce = uniqid();

        $query = [
            'authorization' => 'OPEN-FORM-PARAM',
            'appId' => $this->app->config->get('app_id'),
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'content' => $content,
            'signature' => $this->getSignature($content, $timestamp , $nonce),
        ];

        return $this->url($uri) . '?' . http_build_query($query);
    }

    /**
     * 使用内容进行签名
     *
     * @param $params
     * @return string
     */
    protected function getBodySign(array $params) : string
    {
        $appId = $this->app->config->get('app_id');
        $timestamp = date('YmdHis');
        $nonce = uniqid();
        $signature = $this->getSignature(json_encode($params), $timestamp, $nonce);
        return 'OPEN-BODY-SIG AppId="'.$appId.'",Timestamp="'.$timestamp.'",Nonce="'.$nonce.'",Signature="'.$signature.'"';
    }

    /**
     * @return string
     * @throws GuzzleException
     * @throws InvalidArgumentException
     */
    protected function getAccessTokenSign() : string
    {
        return 'OPEN-ACCESS-TOKEN AccessToken="'.$this->app->getAccessToken().'"';
    }

    /**
     * 获取签名
     *
     * @param string $content
     * @param string $timestamp
     * @param string $nonce
     * @return string
     */
    protected function getSignature(string $content, string $timestamp, string $nonce) : string
    {
        $singStr = $this->app->config->get('app_id') .
            $timestamp .
            $nonce .
            bin2hex(hash('SHA256', $content, true));

        return base64_encode(hash_hmac('SHA256', $singStr, $this->app->config->get('app_key'),true));
    }

    /**
     * 获取简单签名
     *
     * @param $params
     * @return string
     */
    protected function getSimpleSignature($params) : string
    {
        // 待签名字符串
        $signStr = implode('', array_intersect_key($params, array_flip(['appId', 'timestamp', 'nonce']))) .
            $this->app->config->get('app_key');

        return bin2hex(hash('SHA256', $signStr, true));
    }

    /**
     * @param string $uri
     * @return string
     */
    protected function url($uri = '') : string
    {
        $host = $this->app->config->get('sandbox') ?
            $this->app->config->get('dev_url') :
            $this->app->config->get('pro_url');

        return rtrim($host, '/').'/'.ltrim($uri, '/');
    }
}
