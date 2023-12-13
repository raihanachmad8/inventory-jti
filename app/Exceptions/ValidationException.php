<?php
class ValidationException extends Exception
{
    protected array $errors;

    public function __construct(array $errors = [], $code = 0, Throwable $previous = null)
    {

        $this->errors = $errors;
        $message = json_encode(['error' => $errors]);
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
