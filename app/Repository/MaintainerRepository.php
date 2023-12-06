<?php

require_once __DIR__ . '/../Models/Maintainer.php';

class MaintainerRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll() : array
    {
        try {
            $query = "SELECT Maintainer.Nama as Nama_Maintainer, ID_Maintainer FROM Maintainer";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $maintainers = [];
            if ($result) {
                foreach ($result as $maintainer) {
                    $maintainers[] = new Maintainer($maintainer);
                }
            }
            return $maintainers;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function get(
        ?string $ID_Maintainer = null,
        ?string $Nama = null,
    ): ?Maintainer {
        try {
            $sql = "SELECT Maintainer.Nama as Nama_Maintainer, Maintainer.ID_Maintainer FROM Maintainer WHERE 1";
            if ($ID_Maintainer !== null) {
                $sql .= " AND ID_Maintainer = :ID_Maintainer";
            }
            if ($Nama !== null) {
                $sql .= " AND Nama = :Nama";
            }

            $statement = $this->connection->prepare($sql);
            if ($ID_Maintainer !== null) {
                $statement->bindParam('ID_Maintainer', $ID_Maintainer);
            }
            if ($Nama !== null) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Maintainer($result) : null;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert(Maintainer $maintainer): bool
    {
        try {
            $sql = "INSERT INTO Maintainer (ID_Maintainer, Nama) VALUES (:ID_Maintainer, :Nama)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($maintainer->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Maintainer $maintainer): bool
    {
        try {
            $statement = $this->connection->prepare("UPDATE Maintainer SET Nama = :Nama WHERE ID_Maintainer = :ID_Maintainer");
            $statement->execute($maintainer->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(
        ?string $ID_Maintainer = null,
        ?string $Nama = null,
    ): bool {
        try {
            $sql = "DELETE FROM Maintainer WHERE 1";
            if ($ID_Maintainer) {
                $sql .= " AND ID_Maintainer = :ID_Maintainer";
            }
            if ($Nama) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintainer) {
                $statement->bindParam(':ID_Maintainer', $ID_Maintainer);
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
