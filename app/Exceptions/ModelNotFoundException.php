<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ModelNotFoundException extends GeneralException implements HttpExceptionInterface
{
    public function __construct(string $error_key = 'model_not_found', string $message = 'No results found.', int $code = 404, Throwable $previous = null)
    {
        parent::__construct($error_key, $message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }

    public function getHeaders(): array
    {
        return [];
    }
}
