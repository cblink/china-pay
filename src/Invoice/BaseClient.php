<?php
namespace Cblink\ChinaPay\Invoice;

use Cblink\ChinaPay\Application;
use Cblink\ChinaPay\Invoice;
use Cblink\ChinaPay\Invoice\Exceptions\InvoiceException;
use Ramsey\Uuid\Uuid;

/**
 * Class BaseClient
 * @package App\Feature\ChinaPay\Kernel
 */
abstract class BaseClient
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Invoice $invoice)
    {
        $this->app = $invoice;
    }

    /**
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     * @throws \Exception
     */
    protected function request(array $params = []) : array
    {
        // 请求参数
        $params = array_merge($params, [
            'msgId' => Uuid::uuid1()->toString(),
            'msgSrc' => $this->app->config->get('msg_src'),
            'merchantId' => $this->app->config->get('merchant_id'),
            'terminalId' => $this->app->config->get('terminal_id'),
            'requestTimestamp' => date('Y-m-d H:i:s'),
        ]);
        // 获取签名
        $params['sign'] = $this->getSign($params);

        // 请求参数
        $options = [
            'http_errors' => false,
            'verify' => false,
            'json' => $params
        ];

        $res = $this->app->http_client->request(
            'POST',
            $this->url(),
            $options
        );

        $this->logRequest($res);

        return $this->requestData($res);
    }

    /**
     * @param $res
     * @return mixed
     */
    protected function requestData($res)
    {
        // 解析json
        $data = json_decode($response = $res->getBody()->getContents(), true);

        if($res->getStatusCode() !== 200 || json_last_error()) {
            throw new InvoiceException('invoice request fail!', 1001);
        }

        if(!(!array_key_exists('resultCode', $data) && $data['resultCode'] === 'SUCCESS')){
            throw new InvoiceException($data['resultMsg'] ?? '', 1002);
        }

        return $data;
    }

    /**
     * @param $res
     */
    protected function logRequest($res)
    {
        // 如果开启调试，每次请求结果都记录到日志
        if(!$this->app->config->get('debug')){
            return;
        }

        $this->app->logger->info("request result", [
            'statusCode' => $res->getStatusCode(),
            'data' => $res->getBody()->getContents()
        ]);
    }

    /**
     * 获取签名
     *
     * @param $params
     * @return string
     */
    protected function getSign($params) : string
    {
        ksort($params);

        // 待签名字符
        $signString = urldecode(http_build_query(array_filter($params)));

        // 签名
        return strtoupper(hash('SHA256', $signString . $this->app->config->get('key')));
    }

    /**
     * 获取请求的url
     *
     * @return string
     */
    protected function url() : string
    {
        return $this->app->config->get('sandbox') ?
            $this->app->config->get('dev_url') :
            $this->app->config->get('pro_url');
    }

}
