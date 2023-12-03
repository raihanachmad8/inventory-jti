<?php

class OTPVerifyRequest
{
    public ?string $otp;
    public ?string $id_pengguna;
    public function __construct(array $otp = null)
    {
        if ($otp !== null) {
            $this->otp = $otp['otp'] ?? null;
            $this->id_pengguna = $otp['id_pengguna'] ?? null;
        }
    }

    public function validate() : ?array
    {
        $err = [];
        if (empty($this->otp)) {
            $err['otp'] = 'OTP is required.';
        }
        if (empty($this->id_pengguna)) {
            $err['id_pengguna'] = 'User ID is required.';
        }

        if (!is_numeric($this->otp)) {
            $err['otp'] = 'OTP must be numeric.';
        }
        return $err;
    }
}
