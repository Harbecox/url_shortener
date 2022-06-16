<?php

namespace App\Exceptions\API;

use Exception;

class MethodNotAllowedException extends BaseException
{
    protected $code = 405;
    protected $message = "status code indicates that the method received in the request-line is known by the origin server but not supported by the target resource.";
}
