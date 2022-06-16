<?php

namespace App\Exceptions\API;

use Exception;

class UnauthorizedException extends BaseException
{
    protected $code = 401;
    protected $message = 'Token is required for this request.';
}
