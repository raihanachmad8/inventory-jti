<?php

class Pengguna
{
    public string $ID_Pengguna;
    public string $ID_Level;
    public string $Nomor_Identitas;
    public string $Nama_Pengguna;
    public string $Password;
    public string $Email;
    public string $Nomor_HP;
    public ?string $Foto;
    public string $Status;
    public string $Salt;

    public Level $Level;

}
