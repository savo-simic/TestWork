<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class GeneralException extends \Exception implements HttpExceptionInterface
{
    private string $error_key;

    public function __construct(string $error_key, string $message = "", int $code = 500, Throwable $previous = null)
    {
        if (!$code) {
            $this->code = 500;
        }

        parent::__construct($message, $code, $previous);

        $this->error_key = $error_key;
    }

    public function getErrorKey(): string
    {
        return $this->error_key;
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }

    public function getHeaders() : array
    {
        return [];
    }
}
