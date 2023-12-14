<?php

class DetailTransaksi
{
    public string $ID_DetailTrc;
    public string $ID_Transaksi;
    public string $ID_Inventaris;
    public string $Jumlah;

    // Relation
    public Inventaris $Inventaris;
}
