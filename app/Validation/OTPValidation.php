<?php
require_once __DIR__ . '/Validation.php';

class OTPValidation extends Validation
{
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        if (!isset($this->request['Email']) || $this->request['Email'] === '') {
            $this->addError('Email', 'Email is required');
        }

        if (!isset($this->request['Kode']) || $this->request['Kode'] === '') {
            $this->addError('Kode', 'Kode is required');
        }

        if (empty($this->errors)) {
            $this->validateEmail();
            $this->validateKode();
        }
        return $this;
    }

    private function validateEmail()
    {
        if (!filter_var($this->request['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('Email', 'Email must be valid.');
        }
        $allowedDomains = ['gmail.com', 'student.polinema.ac.id', 'polinema.ac.id', 'dosen.polinema.ac.id', 'staff.polinema.ac.id'];
        $emailDomain = explode('@', $this->request['Email'])[1];
        if (!in_array($emailDomain, $allowedDomains)) {
            $this->addError('Email', 'Email must be a valid Email address.');
        }
    }

    private function validateKode()
    {
        if (strlen($this->request['Kode']) < 6) {
            $this->addError('Kode', 'Kode must be at least 6 characters long.');
        }

        if (!is_numeric((int)$this->request['Kode'])) {
            $this->addError('Kode', 'Kode must be numeric');
        }
    }
}
