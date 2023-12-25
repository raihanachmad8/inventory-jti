<?php

require_once __DIR__ . '/../Models/Maintainer.php';

class MaintainerRepository
{
    private $connection;
    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListMaintainers() : array
    {
        $query = "SELECT ID_Maintainer, Nama as Nama_Maintainer FROM maintainer";
        $result = $this->connection->query($query);
        while ($row = $result->fetchObject('Maintainer')) {
            $maintainer[] = $row;
        }
        return $maintainer ?? [];
    }

    public function getMaintainerById($id) : Maintainer
    {
        try {
            $query = "SELECT ID_Maintainer, Nama as Nama_Maintainer FROM maintainer WHERE ID_Maintainer = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $maintainer = $statement->fetchObject('Maintainer');
            return $maintainer ?? throw new Exception('Maintainer not found');
        } catch (PDOException $exception) {
            throw new Exception('Maintainer not found');
        }
    }

    public function getListMaintainerByID(string $ID_Inventaris) : array{
        try {
            $query = "SELECT
            m.ID_Maintainer, m.Nama as Nama_Maintainer
            FROM Maintainer m
            JOIN maintainerinventaris mi ON mi.ID_Maintainer = m.ID_Maintainer
            JOIN inventaris i ON i.ID_Inventaris = mi.ID_Inventaris
            WHERE i.ID_Inventaris = :id_inventaris
            ORDER BY CAST(SUBSTRING(m.ID_Maintainer FROM 2) AS SIGNED) ASC, m.ID_Maintainer";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id_inventaris' => $ID_Inventaris
            ]);
            while ($row = $statement->fetchObject('Maintainer')) {
                $maintainer[] = $row;
            }
            return $maintainer ?? throw new Exception('Maintainer not found');
        } catch (PDOException $exception) {
            throw new Exception('Maintainer not found');
        }

    }

    public function create(Maintainer $maintainer) : bool
    {
        try {
            $query = "INSERT INTO maintainer (ID_Maintainer, Nama) VALUES (:id, :nama)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $maintainer->ID_Maintainer,
                'nama' => $maintainer->Nama_Maintainer
            ]);
        return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function update(Maintainer $maintainer) : bool
    {
        try {
            $query = "UPDATE maintainer SET Nama = :nama WHERE ID_Maintainer = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $maintainer->ID_Maintainer,
                'nama' => $maintainer->Nama_Maintainer
            ]);

        return $statement->rowCount() > 0 ?? throw new Exception('Failed to update data');
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function delete($id) : bool
    {
        try {
            $query = "DELETE FROM maintainer WHERE ID_Maintainer = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            throw new Exception('Failed to delete data Constraint Inventaris');
        }
    }

    public function search($keyword = '') : array
    {
        $query = "SELECT ID_Maintainer, Nama as Nama_Maintainer FROM maintainer WHERE ID_Maintainer LIKE :keyword OR Nama LIKE :keyword";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'keyword' => "%$keyword%"
        ]);
        while ($row = $statement->fetchObject('Maintainer')) {
            $maintainer[] = $row;
        }
        return $maintainer ?? [];
    }

}
