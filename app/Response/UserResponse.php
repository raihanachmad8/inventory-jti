<?php


class UserResponse
{
    public Pengguna $pengguna;

    public function __construct(Pengguna $pengguna)
    {
        $this->pengguna = $pengguna;
    }
}
