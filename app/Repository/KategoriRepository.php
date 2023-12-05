<?php

require_once __DIR__ . '/../Models/Kategori.php';

class KategoriRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        try {
            $statement = $this->connection->prepare("SELECT * FROM Kategori");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $categories = [];
            if ($result) {
                foreach ($result as $category) {
                    $categories[] = new Kategori($category);
                }
            }
            return $categories;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function get(
        ?string $ID_Kategori = null,
        ?string $Nama = null
    ): ?Kategori {
        try {
            $sql = "SELECT * FROM Kategori WHERE 1";
            if (isset($ID_Kategori)) {
                $sql .= " AND ID_Kategori = :ID_Kategori";
            }
            if (isset($Nama)) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if (isset($ID_Kategori)) {
                $statement->bindParam('ID_Kategori', $ID_Kategori);
            }
            if (isset($Nama)) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Kategori($result) : null;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function update(Kategori $category): bool
    {
        try {
            $statement = $this->connection->prepare("UPDATE kategori SET Nama = :Nama WHERE ID_Kategori = :ID_Kategori");
            $statement->execute($category->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert(Kategori $category): bool
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO kategori (ID_Kategori, Nama) VALUES (:ID_Kategori, :Nama)");
            $statement->execute($category->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(
        ?string $ID_Kategori = null,
        ?string $Nama = null
    ): bool {
        try {
            $sql = "DELETE FROM Kategori WHERE 1";
            if (isset($ID_Kategori)) {
                $sql .= " AND ID_Kategori = :ID_Kategori";
            }
            if (isset($Nama)) {
                $sql .= " AND Nama = :Nama";
            }
            $statement = $this->connection->prepare($sql);
            if (isset($ID_Kategori)) {
                $statement->bindParam('ID_Kategori', $ID_Kategori);
            }
            if (isset($Nama)) {
                $statement->bindParam('Nama', $Nama);
            }
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
