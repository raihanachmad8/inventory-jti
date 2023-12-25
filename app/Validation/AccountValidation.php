<?php

require_once __DIR__ . '/Validation.php';

class AccountValidation extends Validation
{
    const STATUS_AKTIF = 'AKTIF';
    const STATUS_TIDAK_AKTIF = 'TIDAK AKTIF';
    const ROLE_DOSEN = 'Dosen';
    const ROLE_MAHASISWA = 'Mahasiswa';
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        if (!isset($this->request['Nomor_Identitas']) || $this->request['Nomor_Identitas'] === '') {
            $this->addError('Nomor_Identitas', 'Nomor Identitas is required');
        }
        if (!isset($this->request['Nama']) || $this->request['Nama'] === '') {
            $this->addError('Nama', 'Nama is required');
        }

        if (!isset($this->request['Nomor_HP']) || $this->request['Nomor_HP'] === '') {
            $this->addError('Nomor_HP', 'Nomor HP is required');
        }

        if (!isset($this->request['Role']) || $this->request['Role'] === '') {
            $this->addError('Role', 'Role is required');
        }

        if (!isset($this->request['Status']) || $this->request['Status'] === '') {
            $this->addError('Status', 'Status is required');
        }


        if (empty($this->errors)) {
            $this->validateNomorIdentitas();
            $this->validateNama();
            $this->validatePhone();
            $this->validateRole();
            $this->validateStatus();
        }

        return $this;
    }

    public function validateUpdate()
    {
        if (!isset($this->request['ID_Pengguna']) || $this->request['ID_Pengguna'] === '') {
            $this->addError('ID_Pengguna', 'ID Pengguna is required');
        }

        if (empty($this->errors)) {
            $this->validateIDPengguna();
        }

        $this->validate();
        return $this;
    }

    public function validateDelete()
    {
        if (!isset($this->request['ID_Pengguna']) || $this->request['ID_Pengguna'] === '') {
            $this->addError('ID_Pengguna', 'ID Pengguna is required');
        }

        if (empty($this->errors)) {
            $this->validateIDPengguna();
        }

        return $this;
    }

    public function validateIDPengguna()
    {
        if (strlen($this->request['ID_Pengguna']) < 1) {
            $this->addError('ID_Pengguna', 'ID Pengguna must be valid');
        }

        if (strlen($this->request['ID_Pengguna']) > 50) {
            $this->addError('ID_Pengguna', 'ID Pengguna must be less than 50 characters');
        }
    }

    private function validateNomorIdentitas()
    {
        if (strlen($this->request['Nomor_Identitas']) < 10) {
            $this->addError('Nomor_Identitas', 'Nomor Identitas must be valid');
        }

        if (!is_numeric((int)$this->request['Nomor_Identitas'])) {
            $this->addError('Nomor_Identitas', 'Nomor Identitas must be numeric');
        }
    }

    public function validateNama()
    {
        if (strlen($this->request['Nama']) < 1) {
            $this->addError('Nama', 'Nama must be valid');
        }

        if (strlen($this->request['Nama']) > 100) {
            $this->addError('Nama', 'Nama must be less than 50 characters');
        }
    }




    public function validatePhone()
    {
        if (substr($this->request['Nomor_HP'], 0, 1) == '0') {
            $this->addError('Nomor_HP', 'Nomor HP must be not start with 0');
        }

        if (strlen($this->request['Nomor_HP']) < 10) {
            $this->addError('Nomor_HP', 'Nomor HP must be valid');
        }
        if (strlen($this->request['Nomor_HP']) > 15) {
            $this->addError('Nomor_HP', 'Nomor HP must be less than 15 characters');
        }

        if (!is_numeric((int)$this->request['Nomor_HP'])) {
            $this->addError('Nomor_HP', 'Nomor HP must be numeric');
        }
        return $this;
    }


    private function validateRole()
    {
        if (!in_array($this->request['Role'], [self::ROLE_DOSEN, self::ROLE_MAHASISWA])) {
            $this->addError('Role', 'Role must be a valid Role.');
        }
    }

    private function validateStatus()
    {
        if (!in_array($this->request['Status'], [self::STATUS_AKTIF, self::STATUS_TIDAK_AKTIF])) {
            $this->addError('Status', 'Status must be valid');
        }
    }
}
