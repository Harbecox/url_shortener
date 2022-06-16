<?php

namespace App\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    public function render($request)
    {
        return view("errors.404");

    }
}
