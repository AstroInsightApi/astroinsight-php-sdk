<?php

namespace AstroInsight\Exceptions;

class ValidationException extends AstroException
{
    protected array $errors = [];

    public function __construct(string $message = "", int $code = 422, ?array $responseData = null, array $errors = [], ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $responseData, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
