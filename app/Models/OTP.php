<?php

class OTP
{
    private string $ID_OTP;
    private string $ID_Pengguna;
    public string $Kode;
    public DateTime $Expired;

    public function __construct(array $otp)
    {
        $this->ID_OTP = $otp['ID_OTP'];
        $this->ID_Pengguna = $otp['ID_Pengguna'];
        $this->Kode = $otp['Kode'];
        $this->Expired = new DateTime($otp['Expired']);
    }


    public function getID() {
        return $this->ID_OTP;
    }

    public function getIDPengguna() {
        return $this->ID_Pengguna;
    }
}
