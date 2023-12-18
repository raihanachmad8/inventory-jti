<?php

interface ValidationInterface {
    public function validate();
    public function hasError() : bool;
    public function getErrors() : ?array;
}

class Validation implements ValidationInterface
{
    protected array $errors = [];
    protected array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function addError(string $key, string $value) : void {
        $this->errors[$key] = $value;
    }

    public function hasError() : bool {
        return !empty($this->errors);
    }

    public function getErrors() : ?array {
        return $this->errors ?? null;
    }

    public function validate()  {
        return $this;
    }
}
