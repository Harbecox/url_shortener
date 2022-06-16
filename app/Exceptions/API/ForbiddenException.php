<?php

namespace App\Exceptions\API;

use Exception;

class ForbiddenException extends BaseException
{
    protected $message = "Not enough token rights for this request.";
}
