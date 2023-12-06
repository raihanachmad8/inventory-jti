<?php

require_once __DIR__ . '/Level.php';


class Pengguna {
    const STATUS_ACTIVE = 'AKTIF';
    const STATUS_INACTIVE = 'TIDAK AKTIF';

    private string $ID_Pengguna;
    private string $ID_Level;
    public string $Nomor_Identitas;
    public string $Nama;
    public string $Nomor_HP;
    public string $Email;
    public string $Password;
    public ?string $Foto = null;
    public string $Status;
    public string $Salt;
    // Relation
    public Level $Level;
    public function __construct(array $user)
    {
        try {
            $this->ID_Pengguna = $user['ID_Pengguna'];
            $this->ID_Level = $user['ID_Level'];
            $this->Nomor_Identitas = $user['Nomor_Identitas'];
            $this->Nama = $user['Nama'];
            $this->Nomor_HP = $user['Nomor_HP'];
            $this->Email = $user['Email'];
            $this->Password = $user['Password'];
            $this->Foto = $user['Foto'] ?? null;
            if (!in_array($user['Status'], [self::STATUS_ACTIVE, self::STATUS_INACTIVE])) {
                throw new InvalidArgumentException('Invalid user status.');
            }
            $this->Status = $user['Status'];
            $this->Salt = $user['Salt'];

        } catch (InvalidArgumentException $e) {
            throw new Exception('Invalid user status.');
        }

    }

    public function toArray(): array
    {
        return [
            'ID_Pengguna' => $this->ID_Pengguna,
            'ID_Level' => $this->ID_Level,
            'Nomor_Identitas' => $this->Nomor_Identitas,
            'Password' => $this->Password,
            'Nama' => $this->Nama,
            'Email' => $this->Email,
            'Nomor_HP' => $this->Nomor_HP,
            'Foto' => $this->Foto,
            'Status' => $this->Status,
            'Salt' => $this->Salt
        ];
    }
    public function getID(): string
    {
        return $this->ID_Pengguna;
    }

    public function getLevelID(): string
    {
        return $this->ID_Level;
    }

}
