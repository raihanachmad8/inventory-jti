<?php

class Session
{
    public string $id;
    public string $Nomor_Identitas;
    public string $level;

    public function __construct(string $id, string $Nomor_Identitas, string $level)
    {
        $this->id = $id;
        $this->Nomor_Identitas = $Nomor_Identitas;
        $this->level = $level;
    }

}
