<?php


return [
    // 是否使用测试环境
    'sandbox' => true,
    // 如果开启调试，每一次的接口返回都会记录到日志
    'debug' => true,
    // 测试地址
    'dev_url' => 'https://mobl-test.chinaums.com/fapiao-api-test/',
    // 正式对接地址
    'pro_url'  => '',
    // 银商商户号
    'merchant_id' => '',
    // 银商终端号
    'terminal_id' => '',
    // 签名密钥
    'key' => '',
    // 消息来源
    'msg_src' => '',
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
