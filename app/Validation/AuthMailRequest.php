<?php

class AuthMailRequest
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

        if (empty($errors)) {
            $this->validateEmail($errors);
        }

        return $errors;
    }

    public function validateEmail(&$errors)
    {
        if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Email must be valid';
        }

        $allowedDomains = ['gmail.com', 'student.polinema.ac.id', 'polinema.ac.id', 'dosen.polinema.ac.id', 'staff.polinema.ac.id'];
        $emailDomain = explode('@', $this->request['email'])[1];
        if (!in_array($emailDomain, $allowedDomains)) {
            $errors['email'][] = 'Email must be a valid domain. gmail.com | polinema.ac.id | ';
        }
    }
}
