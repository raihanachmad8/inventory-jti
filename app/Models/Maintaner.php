<?php

class Maintaner
{
    private string $ID_Maintaner;
    public string $Nama;

    public function __construct(array $maintaner)
    {
        $this->ID_Maintaner = $maintaner['ID_Maintaner'];
        $this->Nama = $maintaner['Nama'];
    }

    public function toArray() : array {
        return [
            'ID_Maintaner' => $this->ID_Maintaner,
            'Nama' => $this->Nama
        ];

    }

    public function getID() {
        return $this->ID_Maintaner;
    }
}
