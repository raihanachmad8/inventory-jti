<?php

class UserDeleteValidation
{
    public array $request;

    public function __construct(array $request = null)
    {
        $this->request = $request;
    }

    public function validate()
    {
        $errors = [];

        if (!isset($this->request['id_pengguna']) && $this->request['id_pengguna'] === '') {
            $errors['id_pengguna'] = 'id_pengguna is required';
        }

        return $errors;

    }
}
