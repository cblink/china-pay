<?php
namespace Cblink\ChinaPay;

/**
 * Class ChinaPay
 *
 * @property \Cblink\ChinaPay\Payment\Base\Base               $base
 * @property \Cblink\ChinaPay\Payment\Base\AccessToken          $access_token   支付的token
 *
 * @property \Cblink\ChinaPay\Payment\Qr\Client                 $qr             扫码支付
 * @property \Cblink\ChinaPay\Payment\H5\Client                 $h5             h5支付
 * @property \Cblink\ChinaPay\Payment\JsApi\Client              $jsapi          微信jsapi支付
 * @property \Cblink\ChinaPay\Payment\Mini\Client               $mini           小程序支付
 * @property \Cblink\ChinaPay\Payment\App\Client                $app            App支付
 *
 * @method string getAccessToken()
 * @method array|string order($type, $platform, array $params)
 * @method array query($type, array $params)
 * @method array close($type, array $params)
 * @method array refund($type, array $params)
 * @method array refundQuery($type, array $params)
 *
 * @package App\Feature\ChinaPay
 */
class Payment extends Application
{
    protected $providers = [
        Payment\Base\ServiceProvider::class,
        Payment\Qr\ServiceProvider::class,
        Payment\H5\ServiceProvider::class,
        Payment\JsApi\ServiceProvider::class,
        Payment\Mini\ServiceProvider::class,
        Payment\App\ServiceProvider::class,
    ];

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->base, $name], $arguments);
    }
}
