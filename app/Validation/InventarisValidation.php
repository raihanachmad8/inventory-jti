<?php

require_once __DIR__ . '/Validation.php';

class InventarisValidation extends Validation
{
    const ASAL_HIBAH = 'HIBAH';
    const ASAL_BELI = 'BELI';
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate() {
        if (!isset($this->request['Nama']) || $this->request['Nama'] === '') {
            $this->addError('Nama', 'Nama is required');
        }

        if (!isset($this->request['Stok']) || $this->request['Stok'] === '') {
            $this->addError('Stok', 'Stok is required');
        }

        if (!isset($this->request['ID_Kategori']) || $this->request['ID_Kategori'] === '') {
            $this->addError('ID_Kategori', 'ID Kategori is required');
        }

        if (!isset($this->request['Asal']) || $this->request['Asal'] === '') {
            $this->addError('Asal', 'Asal is required');
        }

        if (!isset($this->request['Deskripsi']) || $this->request['Deskripsi'] === '') {
            $this->addError('Deskripsi', 'Deskripsi is required');
        }

        if (empty($this->errors)) {
            $this->validateNama();
            $this->validateStok();
            $this->validateIDKategori();
            $this->validateAsal();
            $this->validateDeskripsi();
        }

        return $this;
    }

    public function validateUpdate()
    {
        if (!isset($this->request['ID_Inventaris']) || $this->request['ID_Inventaris'] === '') {
            $this->addError('ID_Inventaris', 'ID Inventaris is required');
        }

        if (empty($this->errors)) {
            $this->validateIDInventaris();
        }

        $this->validate();
        return $this;
    }

    public function validateDelete()
    {
        if (!isset($this->request['ID_Inventaris']) || $this->request['ID_Inventaris'] === '') {
            $this->addError('ID_Inventaris', 'ID Inventaris is required');
        }

        if (empty($this->errors)) {
            $this->validateIDInventaris();
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

    public function validateNama()
    {
        if (strlen($this->request['Nama']) < 1) {
            $this->addError('Nama', 'Nama must be valid');
        }

        if (strlen($this->request['Nama']) > 100) {
            $this->addError('Nama', 'Nama must be less than 100 characters long.');
        }
    }

    public function validateStok()
    {
        if (strlen($this->request['Stok']) < 0) {
            $this->addError('Stok', 'Stok must not be negative');
        }

        if (!is_numeric($this->request['Stok'])) {
            $this->addError('Stok', 'Stok must be numeric');
        }
    }

    public function validateIDKategori()
    {
        if (strlen($this->request['ID_Kategori']) < 1) {
            $this->addError('ID_Kategori', 'ID Kategori must be valid');
        }
    }

    public function validateAsal()
    {
        if (!in_array($this->request['Asal'], [self::ASAL_HIBAH, self::ASAL_BELI])) {
            $this->addError('Asal', 'Asal inventaris tidak valid');
        }
    }

    public function validateDeskripsi()
    {
        if (strlen($this->request['Deskripsi']) < 1) {
            $this->addError('Deskripsi', 'Deskripsi must be valid');
        }
    }
}
