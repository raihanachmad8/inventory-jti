<?php

require_once __DIR__ . '/../Repository/AuthRepository.php';

class AuthLoginRequest
{
    public array $request;

    public function __construct(array $request) {
        $this->request = $request;
    }
    public function validate()
    {
        $errors = [];

        if (!isset($this->request['email']) || $this->request['email'] === '') {
            $errors['email'][] = 'Email is required';
        }
        if (!isset($this->request['password']) || $this->request['password'] === '') {
            $errors['password'][] = 'Password is required';
        }
        if (empty($errors)) {
            $this->validateEmail($errors);
            $this->validatePassword($errors);
        }

        return $errors;
    }

    public function validateEmail(&$errors)
    {
        if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Email must be a valid email address.';
        }

        $allowedDomains = ['gmail.com', 'student.polinema.ac.id', 'polinema.ac.id', 'dosen.polinema.ac.id', 'staff.polinema.ac.id'];
        $emailDomain = explode('@', $this->request['email'])[1];
        if (!in_array($emailDomain, $allowedDomains)) {
            $errors['email'][] = 'Email must be a valid domain.';
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
    }

}
