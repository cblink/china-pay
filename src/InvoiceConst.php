<?php
namespace Cblink\ChinaPay;

/**
 * Class ChinaPayConst
 * @package Cblink\ChinaPay\Kennel
 */
class InvoiceConst
{
    // 发票材质
    const INVOICE_MATERIAL_PAPAER = 'PAPER';                // 纸质发票
    const INVOICE_MATERIAL_ELECTRONIC = 'ELECTRONIC';       // 电子发票
    // 发票类型
    const INVOICE_TYPE_PLAIN = 'PLAIN';                     // 普通发票
    const INVOICE_TYPE_VAT = 'VAT';                         // 增值税专用发票
    // 发票商品信息, 发票行性质
    const INVOICE_GOOD_ATTRIBUTE_NORMAL = 0;                // 正常行
    const INVOICE_GOOD_ATTRIBUTE_DISCOUNT = 1;              // 折扣行
    const INVOICE_GOOD_ATTRIBUTE_DISCOUNTED = 2;            // 被折扣行


}
