<?php

class User {
    public ?string $id_pengguna;
    public ?string $id_level;
    public ?string $nomor_identitas;
    public ?string $password;
    public ?string $nama;
    public ?string $email;
    public ?string $nomor_hp;
    public ?string $foto;
    public ?string $status;
    public ?string $salt;
    public function __construct(array $user = null)
    {
        if ($user !== null) {
            $this->id_pengguna = $user['id_pengguna'] ?? null;
            $this->id_level = $user['id_level'] ?? null;
            $this->nomor_identitas = $user['nomor_identitas'] ?? null;
            $this->password = $user['password'] ?? null;
            $this->nama = $user['nama'] ?? null;
            $this->email = $user['email'] ?? null;
            $this->nomor_hp = $user['nomor_hp'] ?? null;
            $this->foto = $user['foto'] ?? null;
            $this->status = $user['status'] ?? null;
            $this->salt = $user['salt'] ?? null;
        }

    }
}
