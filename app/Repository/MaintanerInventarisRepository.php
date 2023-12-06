<?php

require_once __DIR__ . '/../Models/Inventaris.php';
require_once __DIR__ . '/../Models/Maintainer.php';
require_once __DIR__ . '/../Models/MaintainerInventaris.php';
require_once __DIR__ . '/../Repository/MaintainerRepository.php';
require_once __DIR__ . '/../Repository/InventarisRepository.php';

class MaintainerInventarisRepository
{
    private PDO $connection;
    private MaintainerRepository $MaintainerRepository;
    private InventarisRepository $InventarisRepository;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->MaintainerRepository = new MaintainerRepository($connection);
        $this->InventarisRepository = new InventarisRepository($connection);
    }

    public function getAll(): array
    {
        try {
            $query = "
            SELECT Maintainer.ID_Maintainer, Maintainer.Nama as Nama_Maintainer, Inventaris.Nama as Nama_Barang, Inventaris.*, Kategori.*
            FROM Maintainer
            INNER JOIN MaintainerInventaris ON Maintainer.ID_Maintainer = MaintainerInventaris.ID_Maintainer
            INNER JOIN Inventaris ON MaintainerInventaris.ID_Inventaris = Inventaris.ID_Inventaris
            INNER JOIN Kategori ON Inventaris.ID_Kategori = Kategori.ID_Kategori
            ";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $maintainerInventaris = [];
            if ($result) {
                foreach ($result as $maintainerInventari) {
                    $maintainer = new Maintainer($maintainerInventari);
                    $inventaris = new Inventaris($maintainerInventari);
                    $inventaris->Nama = $maintainerInventari['Nama_Barang'];
                    $inventaris->Kategori = new Kategori($maintainerInventari);
                    $maintainerInventaris[] = new MaintainerInventaris($maintainer, $inventaris);
                }
            }
            return $maintainerInventaris;
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data maintainer dan inventaris');
        }
    }

    public function get(
        ?string $ID_Maintainer = null,
        ?string $ID_Inventaris = null,
    ): ?MaintainerInventaris
    {
        try {
            $query = "
                SELECT Maintainer.ID_Maintainer, Maintainer.Nama as Nama_Maintainer, Inventaris.Nama as Nama_Inventaris, Inventaris.*, Kategori.*
                FROM Maintainer
                INNER JOIN MaintainerInventaris ON Maintainer.ID_Maintainer = MaintainerInventaris.ID_Maintainer
                INNER JOIN Inventaris ON MaintainerInventaris.ID_Inventaris = Inventaris.ID_Inventaris
                INNER JOIN Kategori ON Inventaris.ID_Kategori = Kategori.ID_Kategori
                WHERE 1
            ";

            if ($ID_Maintainer !== null) {
                $query .= " AND Maintainer.ID_Maintainer = :ID_Maintainer";
            }

            if ($ID_Inventaris !== null) {
                $query .= " AND Inventaris.ID_Inventaris = :ID_Inventaris";
            }

            $statement = $this->connection->prepare($query);

            if ($ID_Maintainer !== null) {
                $statement->bindParam('ID_Maintainer', $ID_Maintainer);
            }

            if ($ID_Inventaris !== null) {
                $statement->bindParam('ID_Inventaris', $ID_Inventaris);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return null;
            }

            $inventaris = new Inventaris($result);
            $inventaris->Nama = $result['Nama_Inventaris'];
            $maintainer = new Maintainer($result);
            $inventaris->Kategori = new Kategori($result);

            return new MaintainerInventaris($maintainer, $inventaris);
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data detail maintainer dan inventaris');
        }
    }

    public function insert(string $ID_Inventaris, string $ID_Maintainer): bool
    {
        try {
            $sql = "INSERT INTO MaintainerInventaris (ID_Maintainer, ID_Inventaris) VALUES (:ID_Maintainer, :ID_Inventaris)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                'ID_Maintainer' => $ID_Maintainer,
                'ID_Inventaris' => $ID_Inventaris,
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update(string $ID_Inventaris, string $ID_Maintainer): bool
    {
        try {
            $sql = "UPDATE MaintainerInventaris SET ID_Maintainer = :ID_Maintainer WHERE ID_Inventaris = :ID_Inventaris";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                'ID_Maintainer' => $ID_Maintainer,
                'ID_Inventaris' => $ID_Inventaris,
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete(
        ?string $ID_Maintainer = null,
        ?string $ID_Inventaris = null,
    ): bool {
        try {
            $sql = "DELETE FROM MaintainerInventaris WHERE 1";
            if ($ID_Maintainer) {
                $sql .= " AND ID_Maintainer = :ID_Maintainer";
            }
            if ($ID_Inventaris) {
                $sql .= " AND ID_Inventaris = :ID_Inventaris";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintainer) {
                $statement->bindParam('ID_Maintainer', $ID_Maintainer);
            }
            if ($ID_Inventaris) {
                $statement->bindParam('ID_Inventaris', $ID_Inventaris);
            }
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function getMaintainerInventarisWithFilter(
        ?string $keyword = null,
        ?string $groupby = null,
        ?string $orderby = null,
        ?string $sort = 'ASC',
        ?int $limit = null,
        ?int $offset = null
    ): ?array {
        try {
            $sql = "SELECT * FROM MaintainerInventaris WHERE 1";

            if ($keyword !== null) {
                $sql .= " AND (ID_Maintainer LIKE :keyword OR ID_Inventaris LIKE :keyword)";
                $keyword = "%$keyword%";
            }

            if ($groupby !== null) {
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

            if ($keyword !== null) {
                $statement->bindParam(':keyword', $keyword);
            }

            if ($limit !== null) {
                $statement->bindParam(':limit', $limit, PDO::PARAM_INT);

                if ($offset !== null) {
                    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
                }
            }

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $maintainerInventaris = [];
            if ($result) {
                foreach ($result as $maintainerInventari) {
                    $inventaris = $this->InventarisRepository->get($maintainerInventari['ID_Inventaris']);
                    $maintainer = $this->MaintainerRepository->get($maintainerInventari['ID_Maintainer']);
                    $maintainerInventaris[] = new MaintainerInventaris($maintainer, $inventaris);
                }
            }
            return $maintainerInventaris;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getListMaintainer() : array
    {
        try {
            return $this->MaintainerRepository->getAll();
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data maintainer');
        }
    }

    public function getListKategori()
    {
        try {
            return $this->InventarisRepository->getAll();
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data kategori');
        }
    }

}
