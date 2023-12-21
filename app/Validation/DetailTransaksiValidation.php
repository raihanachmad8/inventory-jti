<?php

require_once __DIR__ . '/Validation.php';

class DetailTransaksiValidation extends Validation
{
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate()
    {
        if (!isset($this->request['ID_DetailTrc']) || $this->request['ID_DetailTrc'] === '') {
            $this->addError('ID_DetailTrc', 'ID_DetailTrc is required');
        }

        if (!isset($this->request['ID_Transaksi']) || $this->request['ID_Transaksi'] == '') {
            $this->addError('ID_Transaksi', 'ID_Transaksi is required');
        }

        if (!isset($this->request['ID_Inventaris']) || $this->request['ID_Inventaris'] == '') {
            $this->addError('ID_Inventaris', 'ID_Inventaris is required');
        }

        if (!isset($this->request['Jumlah']) || $this->request['Jumlah'] == '') {
            $this->addError('Jumlah', 'Jumlah is required');
        }

        if (empty($this->errors)) {
            $this->validateIDDetailTrc();
            $this->validateIDTransaksi();
            $this->validateIDInventaris();
            $this->validateJumlah();
        }
    }

    private function validateIDDetailTrc()
    {
        if (strlen($this->request['ID_DetailTrc']) < 1) {
            $this->addError('ID_DetailTrc', 'ID_DetailTrc must be valid');
        }
        if (strlen($this->request['ID_DetailTrc']) > 50) {
            $this->addError('ID_DetailTrc', 'ID_DetailTrc must be less than 50 character');
        }
    }

    private function validateIDTransaksi()
    {
        if (strlen($this->request['ID_Transaksi']) < 1) {
            $this->addError('ID_Transaksi', 'ID_Transaksi must be valid');
        }
        if (strlen($this->request['ID_Transaksi']) > 50) {
            $this->addError('ID_Transaksi', 'ID_Transaksi must be less than 50 character');
        }
    }

    private function validateIDInventaris()
    {
        if (strlen($this->request['ID_Inventaris']) < 1) {
            $this->addError('ID_Inventaris', 'ID_Inventaris must be valid');
        }
        if (strlen($this->request['ID_Inventaris']) > 50) {
            $this->addError('ID_Inventaris', 'ID_Inventaris must be less than 50 character');
        }
    }

    private function validateJumlah()
    {
        if (strlen($this->request['Jumlah']) < 0) {
            $this->addError('Jumlah', 'Jumlah must not be negative');
        }

        if (!is_numeric((int)$this->request['Jumlah'])) {
            $this->addError('Jumlah', 'Jumlah must be numeric');
        }
    }
}
