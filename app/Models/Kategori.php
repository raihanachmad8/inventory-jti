<?php

class Kategori
{
    private string $ID_Kategori;
    public string $Nama;

    public function __construct(array $kategori)
    {
        $this->ID_Kategori = $kategori['ID_Kategori'];
        $this->Nama = $kategori['Nama'];
    }

    public function toArray() {
        return [
            'ID_Kategori' => $this->ID_Kategori,
            'Nama' => $this->Nama
        ];
    }

    public function getID() {
        return $this->ID_Kategori;
    }
}
