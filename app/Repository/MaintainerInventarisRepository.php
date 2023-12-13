<?php

require_once __DIR__ . '/../Models/MaintainerInventaris.php';
require_once __DIR__ . '/../Models/Maintainer.php';
require_once __DIR__ . '/../Models/Inventaris.php';
require_once __DIR__ . '/../Models/Kategori.php';

class MaintainerInventarisRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListMaintainerInventaris() : array
    {
        try {
            $query = "SELECT
            i.ID_Inventaris, i.Nama as Nama_Inventaris, i.Stok, i.ID_Kategori, i.Asal, i.Deskripsi, i.Gambar, k.Nama as Nama_Kategori, m.ID_Maintainer, m.Nama as Nama_Maintainer FROM inventaris i
            Join kategori k on i.ID_Kategori = k.ID_Kategori
            join MaintainerInventaris mi on i.ID_Inventaris = mi.ID_Inventaris
            join Maintainer m on mi.ID_Maintainer = m.ID_Maintainer
            WHERE i.ID_Kategori = k.ID_Kategori AND i.Nama LIKE :keyword OR k.Nama LIKE :keyword
            ORDER BY i.ID_Inventaris ASC
            FROM MaintainerInventaris";
            $result = $this->connection->query($query);
            while ($row = $result->fetchObject('MaintainerInventaris')) {
                $maintainerInventaris[] = $row;
            }
            return $maintainerInventaris ?? [];
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function get(string $id_inventaris)
    {
        try {
            $query = "SELECT
            i.ID_Inventaris
            FROM inventaris i
            JOIN kategori k ON i.ID_Kategori = k.ID_Kategori
            JOIN MaintainerInventaris mi ON i.ID_Inventaris = mi.ID_Inventaris
            JOIN Maintainer m ON mi.ID_Maintainer = m.ID_Maintainer
            WHERE i.ID_Inventaris = :id_inventaris
            ORDER BY i.ID_Inventaris ASC";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id_inventaris' => $id_inventaris
            ]);
            $maintainerInventaris = $statement->fetchObject('MaintainerInventaris');
            return $maintainerInventaris ?? throw new Exception('Maintainer Inventaris not found');
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function create(MaintainerInventaris $maintainerInventaris) : bool
    {
        try {
            $query = "INSERT INTO MaintainerInventaris (ID_Maintainer, ID_Inventaris) VALUES (:id_maintainer, :id_inventaris)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id_maintainer' => $maintainerInventaris->ID_Maintainer,
                'id_inventaris' => $maintainerInventaris->ID_Inventaris
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function update(string $id_inventaris, array $maintainerInventaris) : bool
    {
        try {
            $this->connection->beginTransaction();
            $sqlDelete = "DELETE FROM MaintainerInventaris WHERE ID_Inventaris = :id_inventaris";
            $stmtDelete = $this->connection->prepare($sqlDelete);
            $stmtDelete->bindParam(':id_inventaris', $id_inventaris);
            $stmtDelete->execute();

            foreach ($maintainerInventaris as $mainInvent) {
                $sqlInsert = "INSERT INTO MaintainerInventaris (ID_Inventaris, ID_Maintainer) VALUES (:id_inventaris, :id_maintainer)";
                $stmtInsert = $this->connection->prepare($sqlInsert);

                $stmtInsert->bindParam(':id_inventaris', $id_inventaris);
                $stmtInsert->bindParam(':id_maintainer', $mainInvent->ID_Maintainer);

                $stmtInsert->execute();
            }

            $this->connection->commit();

            return true;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function delete(string $id_inventaris) : bool
    {
        try {
            $query = "DELETE FROM MaintainerInventaris WHERE ID_Inventaris = :id_inventaris";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id_inventaris' => $id_inventaris
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function search(string $keyword = '') : array
    {
        try {
            $query = "SELECT
            i.ID_Inventaris, i.Nama as Nama_Inventaris, i.Stok, i.Asal,  m.Nama as Nama_Maintainer
            FROM inventaris i
            Join kategori k on i.ID_Kategori = k.ID_Kategori
            join MaintainerInventaris mi on i.ID_Inventaris = mi.ID_Inventaris
            join Maintainer m on mi.ID_Maintainer = m.`ID_Maintainer`
            WHERE i.ID_Kategori = k.ID_Kategori AND i.Nama LIKE :keyword OR k.Nama LIKE :keyword OR m.Nama LIKE :keyword OR i.Asal LIKE :keyword
            GROUP BY i.ID_Inventaris
            ORDER BY CAST(SUBSTRING(i.ID_Inventaris FROM 2) AS SIGNED) ASC, i.ID_Inventaris";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'keyword' => '%' . $keyword . '%'
            ]);
            while ($row = $statement->fetchObject('MaintainerInventaris')) {
                $maintainerInventaris[] = $row;
            }
            return $maintainerInventaris ?? [];
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
