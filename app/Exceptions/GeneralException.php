<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{
    /**
     * @var
     */
    protected $statusCode;

    /**
     * GeneralException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message = '', $code = 0, $statusCode = 400)
    {
        parent::__construct($message, $code);

        $this->statusCode = $statusCode;
    }

    /**
     * GeneralException statusCode.
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * GeneralException response.
     *
     * return array
     */
    public function getResponse()
    {
        return [
            'success' => false,
            'message' => $this->getMessage(),
            'code' => (int)$this->getCode()
        ];
    }
}
