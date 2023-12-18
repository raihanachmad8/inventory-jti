<?php

require_once __DIR__ . '/../Models/Status.php';

class StatusRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListStatus() : array
    {
        $query = "SELECT ID_Status, Nama as Nama_Status FROM status";
        $result = $this->connection->query($query);
        $status = [];
        while ($row = $result->fetchObject('Status')) {
            $status[] = $row;
        }
        return $status;
    }

    public function getStatusById($id) : Status
    {
        $query = "SELECT ID_Status, Nama as Nama_Status FROM status WHERE ID_Status = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $status = $statement->fetchObject('Status');

        return $status;
    }

    public function create(Status $status) :bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO status (ID_Status, Nama) VALUES (:id, :nama)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $status->ID_Status,
                'nama' => $status->Nama_Status
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function update(Status $status) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE status SET Nama = :nama WHERE ID_Status = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $status->ID_Status,
                'nama' => $status->Nama_Status
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function delete(string $id) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "DELETE FROM status WHERE ID_Status = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
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
        $query = "SELECT ID_Status
        FROM status
        ORDER BY CAST(SUBSTRING(ID_Status FROM 2) AS SIGNED) DESC, ID_Status
        LIMIT 1";
        $result = $this->connection->query($query);
        $status = $result->fetch(PDO::FETCH_ASSOC);

        return $status['ID_Status'];
    }
}
