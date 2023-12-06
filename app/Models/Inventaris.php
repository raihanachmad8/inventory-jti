<?php

require_once __DIR__ . '/Kategori.php';

class Inventaris
{
    const ASAL_HIBAH = 'HIBAH';
    const ASAL_BELI = 'BELI';

    public string $ID_Inventaris;
    public string $Nama;
    public string $Stok;
    private string $ID_Kategori;
    public string $Asal;
    public string $Deskripsi;
    public ?string $Gambar = null;

    // Relation
    public Kategori $Kategori;

    public function __construct(array $inventaris)
    {
        try {
            $this->ID_Inventaris = $inventaris['ID_Inventaris'];
            $this->Nama = $inventaris['Nama'];
            $this->Stok = $inventaris['Stok'];
            $this->ID_Kategori = $inventaris['ID_Kategori'];
            if (!in_array($inventaris['Asal'], [self::ASAL_HIBAH, self::ASAL_BELI])) {
                throw new InvalidArgumentException('Asal inventaris tidak valid');
            }
            $this->Asal = $inventaris['Asal'];
            $this->Deskripsi = $inventaris['Deskripsi'];
            $this->Gambar = $inventaris['Gambar'] ?? null;
        } catch (InvalidArgumentException $e) {
            throw new Exception('Asal inventaris tidak valid');
        }
    }

    public function toArray(): array
    {
        return [
            'ID_Inventaris' => $this->ID_Inventaris,
            'Nama' => $this->Nama,
            'Stok' => $this->Stok,
            'ID_Kategori' => $this->ID_Kategori,
            'Asal' => $this->Asal,
            'Deskripsi' => $this->Deskripsi,
            'Gambar' => $this->Gambar ?? null,
        ];
    }

    public function getID(): string
    {
        return $this->ID_Inventaris;
    }

    public function getKategoriID(): string
    {
        return $this->ID_Kategori;
    }
}
