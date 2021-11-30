<?php

namespace App\Exceptions;

use App\Exceptions\GeneralException;

class UserNotFoundException extends GeneralException
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
        parent::__construct(('User not found'), 1003, 404);
    }
}
