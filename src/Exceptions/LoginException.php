<?php

namespace Cuponeria\TransfeeraPhpSdk\Excepetions;

use Exception;
use Throwable;

class LoginException extends Exception implements Throwable
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {

    }
}