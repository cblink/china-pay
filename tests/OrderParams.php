<?php


namespace Tests;


use Illuminate\Support\Arr;

class OrderParams
{
    protected $payload = [];

    public $publicParams = [
        'msgId',
        'merOrderId',
        'srcReserve',
        'instMid',
        'originalAmount',
        'totalAmount',
        'divisionFlag',
        'platformAmount',
        'goods',
        'subOrders',
        'expireTime',
        'notifyUrl',
        'systemId',
        'secureTransaction',
        'limitCreditCard',
        'preauthTransaction',
    ];

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * 获取qrcode参数
     *
     * @return array
     */
    public function getQrCodeParams()
    {
        return array_merge($this->getPublicParams([
            'returnUrl'
        ]), [
            'billNo' => Arr::get($this->payload, 'merOrderId'),
            'billDate' => Arr::get($this->payload, 'billDate')
        ]);
    }

    public function getH5Params()
    {
        return $this->getPublicParams([
            'returnUrl',
            'merAppId',
            'merAppName',
            'sceneType',
        ]);
    }

    public function getJsApiParams()
    {
        return $this->getPublicParams([
            'returnUrl',
            'subOpenId',
            'subAppId',
        ]);
    }

    public function getMiniParams()
    {
        return $this->getPublicParams([
            'returnUrl',
            'subAppId',
            'subOpenId'
        ]);
    }

    public function getAppParams()
    {
        return $this->getPublicParams([
            'returnUrl',
            'subAppId',
        ]);
    }

    /**
     * @param array $params
     * @return array
     */
    protected function getPublicParams(array $params = [])
    {
        return Arr::only($this->payload, array_merge($params, $this->publicParams));
    }

}
