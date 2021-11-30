<?php

namespace App\Exceptions;

use App\Exceptions\GeneralException;

class InvalidPasswordException extends GeneralException
{
    /**
     * Create a new exception instance.
     *
     * @param  string|null  $message
     * @param  mixed  $code
     * @param  mixed  $statusCode
     * @return void
     */
    public function __construct()
    {
        parent::__construct(('The provided password is incorrect.'), 1004, 401);
    }
}
