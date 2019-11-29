<?php

namespace Cblink\ChinaPay;

/**
 * Class PaymentConst
 * @package Cblink\ChinaPay
 */
class PaymentConst
{

    const ORDER_URL = [
        /***
         * 公众号以及服务窗支付
         */
        self::MID_YUEDAN => [
            self::CHANNEL_WEPAY => 'v1/netpay/wx/unified-order',
            self::CHANNE_UNIOPAY => 'v1/netpay/acp/js-pay',
            self::CHANNEL_ALIPAY => 'v1/netpay/trade/create'
        ],
        /**
         * APP支付
         */
        self::MID_APP => [
            // 'v1/netpay/qmf/order' 全名付
            self::CHANNEL_ALIPAY => 'v1/netpay/trade/precreate',
            self::CHANNE_UNIOPAY => 'v1/netpay/uac/app-order',
            self::CHANNEL_WEPAY => 'v1/netpay/wx/app-pre-order'
        ],
        /**
         * 小程序
         */
        self::MID_MINI => [
            self::CHANNEL_ALIPAY =>  'v1/netpay/trade/create',
            self::CHANNEL_WEPAY => '/v1/netpay/wx/unified-order'
        ],
        /**
         *  h5支付
         */
        self::MID_H5 => [
            self::CHANNEL_ALIPAY => 'v1/netpay/trade/h5-pay',
            self::CHANNE_UNIOPAY => 'v1/netpay/qmf/h5-pay',
            self::CHANNEL_WEPAY => '/v1/netpay/uac/order'
        ],
        self::MID_QRPAY => [
        ],
    ];

    /**
     * 通用接口
     */
    // 担保交易撤销
    // 'v1/netpay/secure-cancel',
    // 担保完成
    // '/v1/netpay/secure-complete',

    // 获取Access token
    const URL_ACCESS_TOKEN = 'v1/token/access';

    // 二维码支付下单
    const URL_QR_PAY = 'v1/netpay/bills/get-qrcode';
    const URL_QR_PAY_CLOSE = 'v1/netpay/bills/close-qrcode';
    const URL_QR_PAY_QUERY = 'v1/netpay/bills/query';
    const URL_QR_PAY_REFUND = 'v1/netpay/bills/refund';

    //
    const URL_WEB_PAY = '/v1/netpay/webpay/pay';
    // 关闭订单
    const URL_CLOSE = '/v1/netpay/close';
    // 支付查询结果
    const URL_QUERY = 'v1/netpay/query';
    // 申请退款
    const URL_REFUND = 'v1/netpay/refund';
    // 退款查询
    const URL_REFUND_QUERY = 'v1/netpay/refund-query';


    const MID_YUEDAN = 'YUEDANDEFAULT';
    const MID_APP = 'APPDEFAULT';
    const MID_H5 = 'H5DEFAULT';
    const MID_MINI = 'MINIDEFAULT';
    const MID_QRPAY = 'QRPAYDEFAULT';

    const MID = [
        self::MID_YUEDAN,    // 公众号服务窗支付
        self::MID_APP,       // App支付
        self::MID_H5,        // h5支付
        self::MID_MINI,      // 小程序支付
        self::MID_QRPAY,     // 扫码支付
    ];



    const SCENE = [
        'jsapi' => PaymentConst::MID_YUEDAN,
        'h5' => PaymentConst::MID_H5,
        'scan' => PaymentConst::MID_QRPAY,
        'app' => PaymentConst::MID_APP,
        'mini' => PaymentConst::MID_MINI,
    ];

    /**
     * 支付渠道
     */
    const CHANNEL_ALIPAY = 'alipay';            // 支付宝
    const CHANNEL_WEPAY = 'wehat';           // 微信支付
    const CHANNE_UNIOPAY = 'union';           // 银联支付

    const CHANNEL = [
        self::CHANNEL_ALIPAY,
        self::CHANNEL_WEPAY,
        self::CHANNE_UNIOPAY
    ];


    /**
     *
     */

    const WX_TRADE_TYPE_JSAPI = 'JSAPI';
    const WX_TRADE_TYPE_MINI = 'MINI';
    const WX_TRADE_TYPE_APP = 'APP';

    const WX_TRADE_TYPE = [
        self::WX_TRADE_TYPE_JSAPI,
        self::WX_TRADE_TYPE_MINI
    ];

}
