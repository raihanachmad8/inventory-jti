<?php

class Session
{
    public string $id;
    public string $nomor_identitas;
    public string $level;

    public function __construct(string $id, string $nomor_identitas, string $level)
    {
        $this->id = $id;
        $this->nomor_identitas = $nomor_identitas;
        $this->level = $level;
    }

}
