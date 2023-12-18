<?php

class Session
{
    public string $id;
    public string $Nomor_Identitas;
    public string $Level;

    public function __construct(string $id, string $Nomor_Identitas, string $Level)
    {
        $this->id = $id;
        $this->Nomor_Identitas = $Nomor_Identitas;
        $this->Level = $Level;
    }

}
