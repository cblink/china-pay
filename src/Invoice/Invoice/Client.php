<?php
namespace Cblink\ChinaPay\Invoice\Invoice;

use Cblink\ChinaPay\InvoiceConst;
use Cblink\ChinaPay\Invoice\BaseClient;

/**
 * Class Invoice
 * @package App\Feature\ChinaPay\Invoice
 */
class Client extends BaseClient
{
    /**
     * 开发票
     *
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     */
    public function issue(array $params) : array
    {
        if(array_key_exists('goodsDetail', $params) && !is_string($params['goodsDetail'])){
            $params['goodsDetail'] = json_encode($params['goodsDetail']);
        }

        if(!array_key_exists('invoiceMaterial', $params)){
            $params['invoiceMaterial'] = InvoiceConst::INVOICE_MATERIAL_ELECTRONIC;
        }

        if(!array_key_exists('invoiceType', $params)){
            $params['invoiceType'] = InvoiceConst::INVOICE_TYPE_PLAIN;
        }

        $params['msgType'] = 'issue';

        return $this->request($params);
    }

    /**
     * 查询发票
     *
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     */
    public function query(array $params) : array
    {
        $params['msgType'] = 'query';

        return $this->request($params);
    }


    /**
     * 红冲发票
     *
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     */
    public function reverse(array $params) : array
    {
        $params['msgType'] = 'reverse';

        return $this->request($params);
    }

    /**
     * 发票作废
     *
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     */
    public function invalid(array $params) : array
    {
        $params['msgType'] = 'reverse';

        return $this->request($params);
    }

    /**
     * 撤销发票
     *
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Cblink\ChinaPay\Invoice\Exceptions\InvoiceException
     */
    public function cancel(array $params) : array
    {
        $params['msgType'] = 'reverse';

        return $this->request($params);
    }

}
