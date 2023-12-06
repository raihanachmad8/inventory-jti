<?php

require_once __DIR__ . '/../Models/Inventaris.php';

class InventarisRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getAll() : array
    {
        try {
            $query = "SELECT * FROM Inventaris";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $inventaris = [];
            if ($result) {
                foreach ($result as $inventari) {
                    $inventaris[] = new Inventaris($inventari);
                }
            }
            return $inventaris;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function get(
        ?string $ID_Inventaris = null,
        ?string $Nama = null,
        ?string $Stok = null,
        ?string $ID_Kategori = null,
        ?string $Asal = null,
        ?string $Deskripsi = null,
    ): ?Inventaris {
        try {
            $sql = "SELECT * FROM Inventaris WHERE 1";
            if ($ID_Inventaris) {
                $sql .= " AND ID_Inventaris = :ID_Inventaris";
            }
            if ($Nama) {
                $sql .= " AND Nama = :Nama";
            }
            if ($Stok) {
                $sql .= " AND Stok = :Stok";
            }
            if ($ID_Kategori) {
                $sql .= " AND ID_Kategori = :ID_Kategori";
            }
            if ($Asal) {
                $sql .= " AND Asal = :Asal";
            }
            if ($Deskripsi) {
                $sql .= " AND Deskripsi = :Deskripsi";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Inventaris) {
                $statement->bindParam('ID_Inventaris', $ID_Inventaris);
            }
            if ($Nama) {
                $statement->bindParam('Nama', $Nama);
            }
            if ($Stok) {
                $statement->bindParam('Stok', $Stok);
            }
            if ($ID_Kategori) {
                $statement->bindParam('ID_Kategori', $ID_Kategori);
            }
            if ($Asal) {
                $statement->bindParam('Asal', $Asal);
            }
            if ($Deskripsi) {
                $statement->bindParam('Deskripsi', $Deskripsi);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Inventaris($result) : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function insert(Inventaris $inventaris): bool
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO Inventaris (ID_Inventaris, Nama, Stok, ID_Kategori, Asal, Deskripsi) VALUES (:ID_Inventaris, :Nama, :Stok, :ID_Kategori, :Asal, :Deskripsi)");
            $statement->execute($inventaris->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update(Inventaris $inventaris): bool
    {
        try {
            $statement = $this->connection->prepare("UPDATE Inventaris SET Nama = :Nama, Stok = :Stok, ID_Kategori = :ID_Kategori, Asal = :Asal, Deskripsi = :Deskripsi WHERE ID_Inventaris = :ID_Inventaris");
            $statement->execute($inventaris->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete(
        ?string $ID_Inventaris = null,
        ?string $Nama = null,
        ?string $Stok = null,
        ?string $ID_Kategori = null,
        ?string $Asal = null,
    ): bool
    {
        try {
            $sql = "DELETE FROM Inventaris WHERE 1";
            if ($ID_Inventaris) {
                $sql .= " AND ID_Inventaris = :ID_Inventaris";
            }
            if ($Nama) {
                $sql .= " AND Nama = :Nama";
            }
            if ($Stok) {
                $sql .= " AND Stok = :Stok";
            }
            if ($ID_Kategori) {
                $sql .= " AND ID_Kategori = :ID_Kategori";
            }
            if ($Asal) {
                $sql .= " AND Asal = :Asal";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Inventaris) {
                $statement->bindParam('ID_Inventaris', $ID_Inventaris);
            }
            if ($Nama) {
                $statement->bindParam('Nama', $Nama);
            }
            if ($Stok) {
                $statement->bindParam('Stok', $Stok);
            }
            if ($ID_Kategori) {
                $statement->bindParam('ID_Kategori', $ID_Kategori);
            }
            if ($Asal) {
                $statement->bindParam('Asal', $Asal);
            }
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getInventoryWithFilter(
        ?string $keyword = null,
        ?string $groupby = null,
        ?string $orderby = null,
        ?string $sort = 'ASC',
        ?string $limit = null,
        ?string $offset = null,
    ): ?array {
        try {
            $sql = "SELECT * FROM Inventaris WHERE 1";
            if ($keyword) {
                $sql .= " AND (ID_Inventaris LIKE :keyword OR Nama LIKE :keyword OR Stok LIKE :keyword OR ID_Kategori LIKE :keyword OR Asal LIKE :keyword OR Deskripsi LIKE :keyword)";
            }
            if ($groupby) {
                $sql .= " GROUP BY $groupby";
            }
            if ($orderby !== null) {
                $sql .= " ORDER BY $orderby $sort";

                if ($limit !== null) {
                    $sql .= " LIMIT :limit";

                    if ($offset !== null) {
                        $sql .= " OFFSET :offset";
                    }
                }
            }
            $statement = $this->connection->prepare($sql);
            if ($keyword) {
                $keyword = "%$keyword%";
                $statement->bindParam('keyword', $keyword);
            }
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $inventaris = [];
            if ($result) {
                foreach ($result as $inventari) {
                    $inventaris[] = new Inventaris($inventari);
                }
            }
            return $inventaris;
        } catch (PDOException $e) {
            return null;
        }
    }
}
