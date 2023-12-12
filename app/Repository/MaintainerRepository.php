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
        $maintainer = [];
        while ($row = $result->fetchAll(PDO::FETCH_CLASS, 'Maintainer', ['ID_Maintainer', 'Nama_Maintainer'])) {
            $maintainer[] = $row;
        }
        return $maintainer;
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
        $query = "DELETE FROM maintainer WHERE ID_Maintainer = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        return $statement->rowCount() > 0;
    }

    public function search($keyword = '') : array
    {
        $query = "SELECT ID_Maintainer, Nama as Nama_Maintainer FROM maintainer WHERE ID_Maintainer LIKE :keyword OR Nama LIKE :keyword";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'keyword' => "%$keyword%"
        ]);
        $maintainer = [];
        while ($row = $statement->fetchObject('Maintainer')) {
            $maintainer[] = $row;
        }
        return $maintainer;
    }

}
