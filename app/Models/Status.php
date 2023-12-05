<?php

class Status
{
    private string $ID_Status;
    public string $Nama;

    public function __construct(array $status)
    {
        $this->ID_Status = $status['ID_Status'];
        $this->Nama = $status['Nama'];
    }

    public function toArray() : array {
        return [
            'ID_Status' => $this->ID_Status,
            'Nama' => $this->Nama
        ];

    }

    public function getID() {
        return $this->ID_Status;
    }
}
