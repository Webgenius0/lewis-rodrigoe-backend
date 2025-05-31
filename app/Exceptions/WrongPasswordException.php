<?php

namespace App\Exceptions;

use Exception;

class WrongPasswordException extends Exception
{
    protected $message = 'Wrong Password';
    protected $code = 403; // HTTP status code
}
