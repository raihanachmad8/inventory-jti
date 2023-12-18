<?php

require_once __DIR__ . '/../Models/Level.php';

class LevelRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListLevel() : array
    {
        $query = "SELECT ID_Level, Nama as Nama_Level FROM level";
        $result = $this->connection->query($query);
        $level = [];
        while ($row = $result->fetchObject('Level')) {
            $level[] = $row;
        }
        return $level;
    }

    public function getLevelById($id) : Level
    {
        $query = "SELECT ID_Level, Nama as Nama_Level FROM level WHERE ID_Level = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $level = $statement->fetchObject('Level');

        return $level;
    }

    public function create(Level $level) :bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO level (ID_Level, Nama) VALUES (:id, :nama)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $level->ID_Level,
                'nama' => $level->Nama_Level
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function update(string $id, array $level) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE level SET Nama = :nama WHERE ID_Level = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id,
                'nama' => $level['Nama_Level']
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
            $query = "DELETE FROM level WHERE ID_Level = :id";
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
        $query = "SELECT ID_Level
        FROM level
        ORDER BY CAST(SUBSTRING(ID_Level FROM 2) AS SIGNED) DESC, ID_Level
        LIMIT 1";
        $result = $this->connection->query($query);
        $level = $result->fetch(PDO::FETCH_ASSOC);

        return $level['ID_Level'];

    }
}
