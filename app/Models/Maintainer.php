<?php

class Maintainer
{
    private string $ID_Maintainer;
    public string $Nama;

    public function __construct(array $maintaner)
    {
        $this->ID_Maintainer = $maintaner['ID_Maintainer'];
        $this->Nama = $maintaner['Nama_Maintainer'];
    }

    public function toArray() : array {
        return [
            'ID_Maintainer' => $this->ID_Maintainer,
            'Nama' => $this->Nama
        ];

    }

    public function getID() {
        return $this->ID_Maintainer;
    }
}
