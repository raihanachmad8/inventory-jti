<?php

require_once __DIR__ . '/../Models/Inventaris.php';
require_once __DIR__ . '/../Models/Maintaner.php';
require_once __DIR__ . '/../Models/MaintanerInventaris.php';

class MaintanerInventarisRepository
{
    private PDO $connection;
    private MaintanerRepository $MaintanerRepository;
    private InventarisRepository $InventarisRepository;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->MaintanerRepository = new MaintanerRepository($connection);
        $this->InventarisRepository = new InventarisRepository($connection);
    }

    public function getAll(): array
    {
        try {
            $query = "
            SELECT * FROM MaintanerInventaris
            INNER JOIN Maintaner ON MaintanerInventaris.ID_Maintaner = Maintaner.ID_Maintaner
            INNER JOIN Inventaris ON MaintanerInventaris.ID_Inventaris = Inventaris.ID_Inventaris";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $maintanerInventaris = [];
            if ($result) {
                foreach ($result as $maintanerInventari) {
                    $inventaris = new Inventaris($maintanerInventari);
                    $maintaner = new Maintaner($maintanerInventari);
                    $maintanerInventaris[] = new MaintanerInventaris($maintaner, $inventaris);
                }
            }
            return $maintanerInventaris;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function get(
        ?string $ID_Maintaner = null,
        ?string $ID_Inventaris = null,
    ): ?MaintanerInventaris {
        try {
            $sql = "SELECT * FROM MaintanerInventaris WHERE 1";
            if ($ID_Maintaner) {
                $sql .= " AND ID_Maintaner = :ID_Maintaner";
            }
            if ($ID_Inventaris) {
                $sql .= " AND ID_Inventaris = :ID_Inventaris";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintaner) {
                $statement->bindParam('ID_Maintaner', $ID_Maintaner);
            }
            if ($ID_Inventaris) {
                $statement->bindParam('ID_Inventaris', $ID_Inventaris);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $inventaris = $this->InventarisRepository->get($result['ID_Inventaris']);
                $maintaner = $this->MaintanerRepository->get($result['ID_Maintaner']);
                return new MaintanerInventaris($maintaner, $inventaris);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function insert(MaintanerInventaris $maintanerInventaris): bool
    {
        try {
            $sql = "INSERT INTO MaintanerInventaris (ID_Maintaner, ID_Inventaris) VALUES (:ID_Maintaner, :ID_Inventaris)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($maintanerInventaris->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update(MaintanerInventaris $maintanerInventaris): bool
    {
        try {
            $sql = "UPDATE MaintanerInventaris SET ID_Maintaner = :ID_Maintaner, ID_Inventaris = :ID_Inventaris WHERE ID_Maintaner = :ID_Maintaner AND ID_Inventaris = :ID_Inventaris";
            $statement = $this->connection->prepare($sql);
            $statement->execute($maintanerInventaris->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete(
        ?string $ID_Maintaner = null,
        ?string $ID_Inventaris = null,
    ): bool {
        try {
            $sql = "DELETE FROM MaintanerInventaris WHERE 1";
            if ($ID_Maintaner) {
                $sql .= " AND ID_Maintaner = :ID_Maintaner";
            }
            if ($ID_Inventaris) {
                $sql .= " AND ID_Inventaris = :ID_Inventaris";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Maintaner) {
                $statement->bindParam('ID_Maintaner', $ID_Maintaner);
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

    public function getMaintanerWithInventaris(string $ID_Maintaner): array
    {
        try {
            $sql = "SELECT * FROM MaintanerInventaris WHERE ID_Maintaner = :ID_Maintaner";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam('ID_Maintaner', $ID_Maintaner);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $maintanerInventaris = [];
            if ($result) {
                foreach ($result as $maintanerInventari) {
                    $inventaris = $this->InventarisRepository->get($maintanerInventari['ID_Inventaris']);
                    $maintaner = $this->MaintanerRepository->get($maintanerInventari['ID_Maintaner']);
                    $maintanerInventaris[] = new MaintanerInventaris($maintaner, $inventaris);
                }
            }
            return $maintanerInventaris;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getMaintanerInventarisWithFilter(
        ?string $keyword = null,
        ?string $groupby = null,
        ?string $orderby = null,
        ?string $sort = 'ASC',
        ?int $limit = null,
        ?int $offset = null
    ): ?array {
        try {
            $sql = "SELECT * FROM MaintanerInventaris WHERE 1";

            if ($keyword !== null) {
                $sql .= " AND (ID_Maintaner LIKE :keyword OR ID_Inventaris LIKE :keyword)";
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

            $maintanerInventaris = [];
            if ($result) {
                foreach ($result as $maintanerInventari) {
                    $inventaris = $this->InventarisRepository->get($maintanerInventari['ID_Inventaris']);
                    $maintaner = $this->MaintanerRepository->get($maintanerInventari['ID_Maintaner']);
                    $maintanerInventaris[] = new MaintanerInventaris($maintaner, $inventaris);
                }
            }
            return $maintanerInventaris;
        } catch (PDOException $e) {
            return null;
        }
    }

}
