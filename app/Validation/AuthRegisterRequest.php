<?php
require_once __DIR__ . '/../Repository/AuthRepository.php';
class AuthRegisterRequest
{
    public array $request;

    public function __construct(array $request) {
        $this->request = $request;
    }
    public function validate()
    {
        $errors = [];

        if (!isset($this->request['nomor_identitas']) || $this->request['nomor_identitas'] === '') {
            $errors['nomor_identitas'][] = 'Nomor Identitas is required';
        }

        if (!isset($this->request['nama']) || $this->request['nama'] === '') {
            $errors['nama'][] = 'Nama is required';
        }

        if (!isset($this->request['email']) || $this->request['email'] === '') {
            $errors['email'][] = 'Email is required';
        }


        if (!isset($this->request['nomor_hp']) || $this->request['nomor_hp'] === '') {
            $errors['nomor_hp'][] = 'Phone Number is required';
        }

        if (!isset($this->request['password']) || $this->request['password'] === '') {
            $errors['password'][] = 'Password is required';
        }

        if (empty($errors)) {
            $this->validateIdentity($errors);
            $this->validateNama($errors);
            $this->validateEmail($errors);
            $this->validatePhone($errors);
            $this->validatePassword($errors);
        }


        return $errors;

    }

    public function validateIdentity(&$error, $user = null) {

        if (strlen($this->request['nomor_identitas']) < 10) {
            $error['nomor_identitas'][] = 'Nomor Identitas must be valid';
        }

        if (!is_numeric($this->request['nomor_identitas'])) {
            $error['nomor_identitas'][] = 'Nomor Identitas must be numeric';
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

    public function validateNama(&$errors)
    {
        if (!is_string($this->request['nama'])) {
            $errors['nama'][] = 'Nama must be valid';
        }
    }

    public function validateEmail(&$errors, $email = null)
    {

        if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Email must be a valid email address.';
        }

        $allowedDomains = ['gmail.com', 'student.polinema.ac.id', 'polinema.ac.id', 'dosen.polinema.ac.id', 'staff.polinema.ac.id'];
        $emailDomain = explode('@', $this->request['email'])[1];
        if (!in_array($emailDomain, $allowedDomains)) {
            $errors['email'][] = 'Email must be a valid domain. gmail.com | polinema.ac.id ';
        }

    }

    public function validatePhone(&$errors)
    {
        if (substr($this->request['nomor_hp'], 0, 1) == 0) {
            $errors['nomor_hp'][] = 'Phone Number must be not start with 0';
        }
        if (strlen($this->request['nomor_hp']) < 10) {
            $errors['nomor_hp'][] = 'Phone Number must be at least 10 characters long.';
        }



        if (!is_numeric($this->request['nomor_hp'])) {
            $errors['nomor_hp'][] = 'Phone Number must be numeric';
        }
    }

}
