<?php

class Inventaris
{
    public string $ID_Inventaris;
    public string $Nama_Inventaris;
    public string $Stok;
    public string $ID_Kategori;
    public string $Asal;
    public string $Deskripsi;
    public ?string $Gambar;

    // Relation
    public Kategori $Kategori;

}
