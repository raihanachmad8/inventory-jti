<?php

require_once __DIR__ . '/../Models/Maintaner.php';

class MaintanerRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll() : array
    {
        try {
            $query = "SELECT * FROM Maintaner";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $maintaners = [];
            if ($result) {
                foreach ($result as $maintaner) {
                    $maintaners[] = new Maintaner($maintaner);
                }
            }
            return $maintaners;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function get(
        ?string $ID_Maintaner = null,
        ?string $Nama = null,
    ): ?Maintaner {
        try {
            $sql = "SELECT * FROM Maintaner WHERE 1";
            if ($ID_Maintaner) {
                $sql .= " AND ID_Maintaner = :ID_Maintaner";
            }
            if ($Nama) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintaner) {
                $statement->bindParam('ID_Maintaner', $ID_Maintaner);
            }
            if ($Nama) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Maintaner($result) : null;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert(Maintaner $maintaner): bool
    {
        try {
            $sql = "INSERT INTO Maintaner (ID_Maintaner, Nama) VALUES (:ID_Maintaner, :Nama)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($maintaner->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Maintaner $maintaner): bool
    {
        try {
            $statement = $this->connection->prepare("UPDATE Maintaner SET Nama = :Nama WHERE ID_Maintaner = :ID_Maintaner");
            $statement->execute($maintaner->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(
        ?string $ID_Maintaner = null,
        ?string $Nama = null,
    ): bool {
        try {
            $sql = "DELETE FROM Maintaner WHERE 1";
            if ($ID_Maintaner) {
                $sql .= " AND ID_Maintaner = :ID_Maintaner";
            }
            if ($Nama) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintaner) {
                $statement->bindParam(':ID_Maintaner', $ID_Maintaner);
            }
            if ($Nama) {
                $statement->bindParam(':Nama', $Nama);
            }
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
