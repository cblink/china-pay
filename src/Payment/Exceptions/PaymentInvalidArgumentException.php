<?php

namespace Cblink\ChinaPay\Payment\Exceptions;

use InvalidArgumentException;
use Throwable;

/**
 * Class PaymentInvalidArgumentException
 * @package Cblink\ChinaPay\Payment\Exceptions
 */
class PaymentInvalidArgumentException extends InvalidArgumentException
{
    protected $code = 500;
}
