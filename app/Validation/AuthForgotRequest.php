<?php

class AuthForgotRequest
{
    public array $request;

    public function __construct(array $request) {
        $this->request = $request;
    }
    public function validate()
    {
        $errors = [];

        if (!isset($this->request['id_pengguna']) || $this->request['id_pengguna'] === '') {
            $errors['id_pengguna'][] = 'ID Pengguna is required';
        }
        if (!isset($this->request['password']) || $this->request['password'] === '') {
            $errors['password'][] = 'password is required';
        }

        if (!isset($this->request['password_confirmation']) || $this->request['password_confirmation'] === '') {
            $errors['password_confirmation'][] = 'Confirm password is required';
        }

        if (empty($errors)) {
            $this->validatePassword($errors);
        }

        return $errors;
    }

    public function validatePengguna(&$error) {

        if (strlen($this->request['id_pengguna']) < 10) {
            $error['id_pengguna'][] = 'ID Pengguna must be valid';
        }

    }

    public function validatePassword(&$errors)
    {
        if (strlen($this->request['password']) < 8) {
            $errors['password'][] = 'Password must be at least 8 characters long.';
        }

        if (!preg_match('/[A-Z]/', $this->request['password'])) {
            $errors['password'][] = 'Password must contain at least one uppercase letter.';
        }

        if (!preg_match('/[a-z]/', $this->request['password'])) {
            $errors['password'][] = 'Password must contain at least one lowercase letter.';
        }

        if (!preg_match('/[0-9]/', $this->request['password'])) {
            $errors['password'][] = 'Password must contain at least one number.';
        }

        if (!preg_match('/[^A-Za-z0-9]/', $this->request['password'])) {
            $errors['password'][] = 'Password must contain at least one special character.';
        }

        if ($this->request['password'] !== $this->request['password_confirmation']) {
            $errors['password'][] = 'Password confirmation does not match.';
        }
    }
}
