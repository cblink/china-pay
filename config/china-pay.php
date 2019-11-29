<?php

return [
    // 是否使用测试环境
    'sandbox' => true,
    // 如果开启调试，每一次的接口返回都会记录到日志
    'debug' => true,
    // 支付
    // 签名类型，可选 sign 与 token , token即使用 access_token 方式进行认证
    'sign_type' => 'sign',
    // 测试地址
    'dev_url' => 'http://58.247.0.18:29015/',
    // 正式地址
    'pro_url' => 'https://api-mop.chinaums.com/',
    // 银商订单来源编号,4位
    'order_src' => '',
    'mid' => '',
    'tid' => '',
    'app_id' => '',
    'app_key' => '',
    // 日志配置
    'log' => [
        'name' => 'china-pay',
        // 错误级别
        'level' => 'debug',
        // 保留的日志数
        'days' => 15,
        // 日志生成路径
        'path' => __DIR__.'/../logs/china-pay.log',
    ]
];
