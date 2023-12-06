<?php

require_once __DIR__ . '/../Models/Level.php';

class LevelRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM level WHERE Nama != 'ADMIN' ORDER BY ID_Level ASC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $levels = [];
            if ($result) {
                foreach ($result as $level) {
                    $levels[] = new Level($level);
                }
            }
            return $levels;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function get(
        ?string $ID_Level = null,
        ?string $Nama = null
    ): ?Level
    {
        try {
            $sql = "SELECT * FROM level WHERE 1";
            if (isset($ID_Level)) {
                $sql .= " AND ID_Level = :ID_Level";
            }
            if (isset($Nama)) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if (isset($ID_Level)) {
                $statement->bindParam('ID_Level', $ID_Level);
            }
            if (isset($Nama)) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Level($result) : null;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert(Level $level): bool
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO level (ID_Level, Nama) VALUES (:ID, :Name)");
            $statement->bindParam('ID', $level->getID());
            $statement->bindParam('Name', $level->Nama);
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(Level $level): bool
    {
        try {
            $statement = $this->connection->prepare("UPDATE level SET Nama = :Name WHERE ID_Level = :ID");
            $statement->execute($level->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM level WHERE ID_Level = :ID");
            $statement->bindParam('ID', $id);
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
