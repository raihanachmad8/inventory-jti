<?php

class Inventaris
{
    private string $ID_Inventaris;
    public string $Nama;
    public string $Stok;
    public string $ID_Kategori;
    public string $Asal;
    public string $Deskripsi;
    public ?string $Gambar;

    // Relation
    public ?Kategori $kategori = null;

    public function getIDInventaris() : string
    {
        return $this->ID_Inventaris;
    }
}
