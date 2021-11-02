<?php

namespace Pierre\Trustpackage\Exceptions;


use Exception;


class InvalidKeyException extends Exception
{
    protected $message = 'Config key is missing.';
}
