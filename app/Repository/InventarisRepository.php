<?php

require_once __DIR__ . '/../Models/Inventaris.php';

class InventarisRepository
{
    private $connection;
    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListInventaris() : array
    {
        $query = "SELECT ID_Inventaris, Nama as Nama_Inventaris, Stok, ID_Kategori, Asal, Deskripsi, Gambar FROM inventaris";
        $result = $this->connection->query($query);
        $inventaris = [];
        while ($row = $result->fetchObject('Inventaris')) {
            $inventaris[] = $row;
        }
        return $inventaris;
    }

    public function getInventarisById($id) : Inventaris
    {
        $query = "SELECT ID_Inventaris, Nama as Nama_Inventaris, Stok, ID_Kategori, Asal, Deskripsi, Gambar FROM inventaris WHERE ID_Inventaris = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $inventaris = $statement->fetchObject('Inventaris');

        return $inventaris;
    }

    public function create(Inventaris $inventaris) :bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi, Gambar) VALUES (:id, :nama, :stok, :id_kategori, :asal, :deskripsi, :gambar)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $inventaris->ID_Inventaris,
                'nama' => $inventaris->Nama_Inventaris,
                'stok' => $inventaris->Stok,
                'id_kategori' => $inventaris->ID_Kategori,
                'asal' => $inventaris->Asal,
                'deskripsi' => $inventaris->Deskripsi,
                'gambar' => $inventaris->Gambar
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function getLastId() : string
    {
        $query = "SELECT ID_Inventaris
        FROM inventaris
        ORDER BY CAST(SUBSTRING(ID_Inventaris FROM 2) AS SIGNED) DESC, ID_Inventaris
        LIMIT 1";
        $result = $this->connection->query($query);
        $inventaris = $result->fetch(PDO::FETCH_ASSOC);

        return $inventaris['ID_Inventaris'];
    }

    public function update(Inventaris $inventaris) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE inventaris SET Nama = :nama, Stok = :stok, ID_Kategori = :id_kategori, Asal = :asal, Deskripsi = :deskripsi, Gambar = :gambar WHERE ID_Inventaris = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $inventaris->ID_Inventaris,
                'nama' => $inventaris->Nama_Inventaris,
                'stok' => $inventaris->Stok,
                'id_kategori' => $inventaris->ID_Kategori,
                'asal' => $inventaris->Asal,
                'deskripsi' => $inventaris->Deskripsi,
                'gambar' => $inventaris->Gambar
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function delete($id) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "DELETE FROM inventaris WHERE ID_Inventaris = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            var_dump('success 2', $statement->rowCount() > 0);
            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }


}
