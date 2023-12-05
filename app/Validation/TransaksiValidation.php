<?php

require_once __DIR__ . '/Validation.php';

class TransaksiValidation extends Validation
{
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        if (!isset($this->request['ID_Inventaris']) || $this->request['ID_Inventaris'] === '') {
            $this->addError('ID_Inventaris', 'ID Inventaris is required');
        }

        if (!isset($this->request['ID_Pengguna}']) || $this->request['ID_Pengguna}'] === '') {
            $this->addError('ID_Pengguna}', 'ID Pengguna} is required');
        }

        if (!isset($this->request['ID_Admin']) || $this->request['ID_Admin'] === '') {
            $this->addError('ID_Admin', 'ID_Admin is required');
        }

        if (!isset($this->request['Tanggal_Pinjam']) || $this->request['Tanggal_Pinjam'] === '') {
            $this->addError('Tanggal_Pinjam', 'Tanggal Pinjam is required');
        }

        if (!isset($this->request['Tanggal_Kembali']) || $this->request['Tanggal_Kembali'] === '') {
            $this->addError('Tanggal_Kembali', 'Tanggal Kembali is required');
        }

        if (!isset($this->request['Deskripsi_Keperluan']) || $this->request['Deskripsi_Keperluan'] === '') {
            $this->addError('Deskripsi_Keperluan', 'Deskripsi Keperluan is required');
        }


        if (empty($this->errors)) {
            $this->validateIDInventaris();
            $this->validateIDPengguna();
            $this->validateIDAdmin();
            $this->validateTanggalPinjam();
            $this->validateTanggalKembali();
            $this->validateDeskripsiKeperluan();
        }

        return $this;
    }

    public function validateUpdate()
    {
        if (!isset($this->request['ID_Peminjam']) || $this->request['ID_Peminjam'] === '') {
            $this->addError('ID_Peminjam', 'ID Peminjam is required');
        }

        if (empty($this->errors)) {
            $this->validateIDPeminjam();
        }

        $this->validate();
        return $this;
    }

    public function validateDelete()
    {
        if (!isset($this->request['ID_Peminjam']) || $this->request['ID_Peminjam'] === '') {
            $this->addError('ID_Peminjam', 'ID Peminjam is required');
        }

        if (empty($this->errors)) {
            $this->validateIDPeminjam();
        }

        return $this;
    }

    public function validateIDInventaris()
    {
        if (strlen($this->request['ID_Inventaris']) < 1) {
            $this->addError('ID_Inventaris', 'ID Inventaris must be valid');
        }

        if (strlen($this->request['ID_Inventaris']) > 50) {
            $this->addError('ID_Inventaris', 'ID Inventaris must be less than 50 characters');
        }
    }

    public function validateIDPengguna()
    {
        if (strlen($this->request['ID_Pengguna}']) < 1) {
            $this->addError('ID_Pengguna}', 'ID Pengguna} must be valid');
        }

        if (strlen($this->request['ID_Pengguna}']) > 50) {
            $this->addError('ID_Pengguna}', 'ID Pengguna} must be less than 50 characters');
        }
    }

    public function validateIDPeminjam()
    {
        if (strlen($this->request['ID_Peminjam']) < 1) {
            $this->addError('ID_Peminjam', 'ID Peminjam must be valid');
        }

        if (strlen($this->request['ID_Peminjam']) > 50) {
            $this->addError('ID_Peminjam', 'ID Peminjam must be less than 50 characters');
        }
    }

    public function validateIDAdmin()
    {
        if (strlen($this->request['ID_Admin']) < 1) {
            $this->addError('ID_Admin', 'ID Admin must be valid');
        }

        if (strlen($this->request['ID_Admin']) > 50) {
            $this->addError('ID_Admin', 'ID Admin must be less than 50 characters');
        }
    }

    public function validateTanggalPinjam()
    {
        if (strlen($this->request['Tanggal_Pinjam']) < 1) {
            $this->addError('Tanggal_Pinjam', 'Tanggal Pinjam must be valid');
        }


        if (strtotime($this->request['Tanggal_Pinjam']) > strtotime($this->request['Tanggal_Kembali'])) {
            $this->addError('Tanggal_Pinjam', 'Tanggal Pinjam must be less than Tanggal Kembali');
        }

    }

    public function validateTanggalKembali()
    {
        if (strlen($this->request['Tanggal_Kembali']) < 1) {
            $this->addError('Tanggal_Kembali', 'Tanggal Kembali must be valid');
        }

        if (strtotime($this->request['Tanggal_Pinjam']) > strtotime($this->request['Tanggal_Kembali'])) {
            $this->addError('Tanggal_Kembali', 'Tanggal Kembali must be greater than Tanggal Pinjam');
        }
    }

    public function validateDeskripsiKeperluan()
    {
        if (strlen($this->request['Deskripsi_Keperluan']) < 1) {
            $this->addError('Deskripsi_Keperluan', 'Deskripsi Keperluan must be valid');
        }

        if (strlen($this->request['Deskripsi_Keperluan']) > 255) {
            $this->addError('Deskripsi_Keperluan', 'Deskripsi Keperluan must be less than 255 characters');
        }
    }
}
