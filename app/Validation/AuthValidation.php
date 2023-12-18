<?php

require_once __DIR__ . '/Validation.php';

class AuthValidation extends Validation
{
    const ALLOW_DOMAIN = ['gmail.com', 'student.polinema.ac.id', 'polinema.ac.id', 'dosen.polinema.ac.id', 'staff.polinema.ac.id'];
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {

        if (!isset($this->request['Email']) || $this->request['Email'] === '') {
            $this->addError('Email', 'Email is required');
        }


        if (!isset($this->request['Password']) || $this->request['Password'] === '') {
            $this->addError('Password', 'Password is required');
        }

        if (!isset($this->request['Confirm_Password']) || $this->request['Confirm_Password'] === '') {
            $this->addError('Confirm_Password', 'Confirm Password is required');
        }


        if (empty($this->errors)) {
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();
        }

        return $this;
    }
    public function validateLogin()
    {

        if (!isset($this->request['Email']) || $this->request['Email'] === '') {
            $this->addError('Email', 'Email is required');
        }


        if (!isset($this->request['Password']) || $this->request['Password'] === '') {
            $this->addError('Password', 'Password is required');
        }


        if (empty($this->errors)) {
            $this->validateEmail();
            $this->validatePassword();
        }

        return $this;
    }

    public function validateForgotPassword()
    {
        if (empty($this->request['Email']) || $this->request['Email'] === '') {
            $this->addError('Email', 'Email is required');
        }

        if (empty($this->request['Password']) || $this->request['Password'] === '') {
            $this->addError('Password', 'Password is required');
        }

        if (empty($this->request['Confirm_Password']) || $this->request['Confirm_Password'] === '') {
            $this->addError('Confirm_Password', 'Confirm Password is required');
        }

        if (empty($this->errors)) {
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();
        }
        return $this;
    }


    public function validateEmail()
    {
        if (!filter_var($this->request['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('Email', 'Email must be valid.');
        }
        $emailDomain = explode('@', $this->request['Email'])[1];
        if (!in_array($emailDomain, self::ALLOW_DOMAIN)) {
            $this->addError('Email', 'Email must be a valid origin address.');
        }
        return $this;
    }


    public function validatePassword()
    {
        // if (strlen($this->request['Password']) < 8) {
        //     $this->addError('Password', 'Password must be at least 8 characters long.');
        // }

        // if (!preg_match('/[A-Z]/', $this->request['Password'])) {
        //     $this->addError('Password', 'Password must contain at least one uppercase letter.');
        // }

        if (!preg_match('/[a-z]/', $this->request['Password'])) {
            $this->addError('Password', 'Password must contain at least one lowercase letter.');
        }

        // if (!preg_match('/[0-9]/', $this->request['Password'])) {
        //     $this->addError('Password', 'Password must contain at least one number.');
        // }

        // if (!preg_match('/[^A-Za-z0-9]/', $this->request['Password'])) {
        //     $this->addError('Password', 'Password must contain at least one special character.');
        // }

    }

    public function validateConfirmPassword()
    {
        if ($this->request['Password'] !== $this->request['Confirm_Password']) {
            $this->addError('Password', 'Password confirmation does not match.');
        }
    }


}
