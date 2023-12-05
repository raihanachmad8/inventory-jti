<?php

require_once __DIR__ . '/../Models/Status.php';

class StatusRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAllStatus(): ?array
    {
        try {
            $sql = "SELECT * FROM status";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            $status = [];
            foreach ($result as $row) {
                $status[] = new Status($row);
            }
            return $status;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function get(
        ?string $ID_Status = null,
        ?string $Nama = null
    ): ?Status {
        try {
            $sql = "SELECT * FROM status WHERE 1";
            if (isset($ID_Status)) {
                $sql .= " AND ID_Status = :ID_Status";
            }
            if (isset($Nama)) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if (isset($ID_Status)) {
                $statement->bindParam('ID_Status', $ID_Status);
            }
            if (isset($Nama)) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Status($result) : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function insert(Status $status) : ?bool
    {
        try {
            $sql = "INSERT INTO status (ID_Status, Nama) VALUES (:ID_Status, :Nama)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($status->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Status $status) : ?bool
    {
        try {
            $sql = "UPDATE status SET Nama = :Nama WHERE ID_Status = :ID_Status";
            $statement = $this->connection->prepare($sql);
            $statement->execute($status->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(
        ?string $ID_Status = null,
        ?string $Nama = null
    ): ?Status {
        try {
            $sql = "DELETE FROM status WHERE 1";
            if (isset($ID_Status)) {
                $sql .= " AND ID_Status = :ID_Status";
            }
            if (isset($Nama)) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if (isset($ID_Status)) {
                $statement->bindParam('ID_Status', $ID_Status);
            }
            if (isset($Nama)) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            $status = new Status($result);
            return $status ?? null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

