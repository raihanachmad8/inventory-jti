<?php

require_once __DIR__ . '/Pengguna.php';
require_once __DIR__ . '/Status.php';

class Transaksi
{
    private string $ID_Transaksi;
    private string $ID_Pengguna;
    private string $ID_Admin;
    private string $ID_Status;
    public string $StartDate;
    public string $EndDate;
    public string $Deskripsi_Keperluan;
    public ?string $Jaminan = null;
    public string $Pesan;

    // Relation
    public Pengguna $pengguna;
    public Pengguna $admin;
    public Status $status;
    public array $detailTransaksiList = [];

    public function __construct(array $transaksiData)
    {
        $this->ID_Transaksi = $transaksiData['ID_Transaksi'];
        $this->ID_Pengguna = $transaksiData['ID_Pengguna'];
        $this->ID_Admin = $transaksiData['ID_Admin'];
        $this->ID_Status = $transaksiData['ID_Status'];
        $this->StartDate = $transaksiData['StartDate'];
        $this->EndDate = $transaksiData['EndDate'];
        $this->Deskripsi_Keperluan = $transaksiData['Deskripsi_Keperluan'];
        $this->Jaminan = $transaksiData['Jaminan'] ?? null;
        $this->Pesan = $transaksiData['Pesan'];
    }

    public function toArray() {
        return [
            'ID_Transaksi' => $this->ID_Transaksi,
            'ID_Pengguna' => $this->ID_Pengguna,
            'ID_Admin' => $this->ID_Admin,
            'ID_Status' => $this->ID_Status,
            'StartDate' => $this->StartDate,
            'EndDate' => $this->EndDate,
            'Deskripsi_Keperluan' => $this->Deskripsi_Keperluan,
            'Jaminan' => $this->Jaminan,
            'Pesan' => $this->Pesan
        ];
    }

    public function getID() {
        return $this->ID_Transaksi;
    }

    public function getPenggunaID() {
        return $this->ID_Pengguna;
    }

    public function getAdminID() {
        return $this->ID_Admin;
    }

    public function getStatusID() {
        return $this->ID_Status;
    }
}
