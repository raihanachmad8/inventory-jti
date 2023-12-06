<?php

class Level
{
    private string $ID_Level;
    public string $Nama;

    public function __construct(array $level)
    {
        $this->ID_Level = $level['ID_Level'];
        $this->Nama = $level['Nama'];
    }

    public function toArray()
    {
        return [
            'ID_Level' => $this->ID_Level,
            'Nama' => $this->Nama
        ];
    }

    public function getID()
    {
        return $this->ID_Level;
    }

}
