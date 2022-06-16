<?php

namespace App\Exceptions\API;

use App\Response\ApiResponse;
use Exception;

class BaseException extends Exception
{
    function render($request){
        return ApiResponse::render($this->message,[],false,$this->code);
    }
}
