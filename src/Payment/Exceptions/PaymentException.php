<?php
namespace Cblink\ChinaPay\Payment\Exceptions;

use Exception;

/**
 * Class PaymentException
 * @package Cblink\ChinaPay\Exceptions
 */
class PaymentException extends Exception
{
    /**
     * @var string
     */
    protected $errType = "";

    public function __construct($message = "", $errType = "")
    {
        $this->errType = $errType;
        parent::__construct($message, 500);
    }

    public function getType()
    {
     return $this->errType;
    }
}
