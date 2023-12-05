<?php

require_once __DIR__ . '/Transaksi.php';
require_once __DIR__ . '/Inventaris.php';

class DetailTransaksi
{
    private string $ID_DetailTrc;
    private string $ID_Transaksi;
    public string $ID_Inventaris;
    public string $Jumlah;

    // Relation
    public Transaksi $transaksi;
    public Inventaris $inventaris;

    public function __construct(array $detailtransaksi)
    {
        $this->ID_DetailTrc = $detailtransaksi['ID_DetailTrc'];
        $this->ID_Transaksi = $detailtransaksi['ID_Transaksi'];
        $this->ID_Inventaris = $detailtransaksi['ID_Inventaris'];
        $this->Jumlah = $detailtransaksi['Jumlah'];
    }

    public function toArray()
    {
        return [
            'ID_DetailTrc' => $this->ID_DetailTrc,
            'ID_Transaksi' => $this->ID_Transaksi,
            'ID_Inventaris' => $this->ID_Inventaris,
            'Jumlah' => $this->Jumlah
        ];
    }

    public function getID()
    {
        return $this->ID_DetailTrc;
    }

    public function getTransaksiID()
    {
        return $this->ID_Transaksi;
    }

    public function getInventarisID()
    {
        return $this->ID_Inventaris;
    }
}
