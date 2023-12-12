<?php

require_once __DIR__ . '/../Models/Kategori.php';

class KategoriRepository
{
    private $connection;
    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListKategori() : array
    {
        $query = "SELECT ID_Kategori, Nama as Nama_Kategori FROM kategori";
        $result = $this->connection->query($query);
        $kategori = [];
        while ($row = $result->fetchObject('Kategori')) {
            $kategori[] = $row;
        }
        return $kategori;
    }

    public function getKategoriById($id) : Kategori
    {
        $query = "SELECT ID_Kategori, Nama as Nama_Kategori FROM kategori WHERE ID_Kategori = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $kategori = $statement->fetchObject('Kategori');

        return $kategori[0];
    }

    public function create(Kategori $kategori) : bool
    {
        $query = "INSERT INTO kategori (ID_Kategori, Nama) VALUES (:id, :nama)";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $kategori->ID_Kategori,
            'nama' => $kategori->Nama_Kategori
        ]);
        return $statement->rowCount() > 0;
    }

    public function update(Kategori $kategori) : bool
    {
        $query = "UPDATE kategori SET Nama = :nama WHERE ID_Kategori = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $kategori->ID_Kategori,
            'nama' => $kategori->Nama_Kategori
        ]);
        return $statement->rowCount() > 0;
    }

    public function delete($id) : bool
    {
        $query = "DELETE FROM kategori WHERE ID_Kategori = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->rowCount() > 0;
    }
}
