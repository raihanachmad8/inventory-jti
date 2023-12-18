<?php

class Transaksi
{
    public string $ID_Transaksi;
    public string $ID_Pengguna;
    public string $ID_Admin;
    public string $ID_Status;
    public string $StartDate;
    public string $EndDate;
    public string $Deskripsi_Keperluan;
    public ?string $Jaminan;
    public string $Pesan;

    // Relation
    public Pengguna $Pengguna;
    public Maintainer $Admin;
    public Status $Status;

    public array $DetailTransaksi;
}
