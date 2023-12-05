<?php

require_once __DIR__ . "/../Models/Pengguna.php";
require_once __DIR__ . "/../Repository/LevelRepository.php";

class PenggunaRepository
{
    private ?PDO $connection = null;
    private LevelRepository $levelRepository;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->levelRepository = new LevelRepository($connection);
    }


    public function get(
        ?string $ID_Pengguna = null,
        ?string $ID_Level = null,
        ?string $Nomor_Identitas = null,
        ?string $Password = null,
        ?string $Nama = null,
        ?string $Email = null,
        ?string $Nomor_HP = null,
        ?string $Foto = null,
        ?string $Status = null,
        ?string $Salt = null
    ): ?Pengguna {
        try {
            $sql = "SELECT * FROM pengguna WHERE 1";
            if ($ID_Pengguna != null) {
                $sql .= " AND ID_Pengguna = :ID_Pengguna";
            }
            if ($ID_Level != null) {
                $sql .= " AND ID_Level = :ID_Level";
            }
            if ($Nomor_Identitas != null) {
                $sql .= " AND Nomor_Identitas = :Nomor_Identitas";
            }
            if ($Password != null) {
                $sql .= " AND Password = :Password";
            }
            if ($Nama != null) {
                $sql .= " AND Nama = :Nama";
            }
            if ($Email != null) {
                $sql .= " AND Email = :Email";
            }
            if ($Nomor_HP != null) {
                $sql .= " AND Nomor_HP = :Nomor_HP";
            }
            if ($Foto != null) {
                $sql .= " AND Foto = :Foto";
            }
            if ($Status != null) {
                $sql .= " AND Status = :Status";
            }
            if ($Salt != null) {
                $sql .= " AND Salt = :Salt";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Pengguna != null) {
                $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            }
            if ($ID_Level != null) {
                $statement->bindParam(':ID_Level', $ID_Level);
            }
            if ($Nomor_Identitas != null) {
                $statement->bindParam(':Nomor_Identitas', $Nomor_Identitas);
            }
            if ($Password != null) {
                $statement->bindParam(':Password', $Password);
            }
            if ($Nama != null) {
                $statement->bindParam(':Nama', $Nama);
            }
            if ($Email != null) {
                $statement->bindParam(':Email', $Email);
            }
            if ($Nomor_HP != null) {
                $statement->bindParam(':Nomor_HP', $Nomor_HP);
            }
            if ($Foto != null) {
                $statement->bindParam(':Foto', $Foto);
            }
            if ($Status != null) {
                $statement->bindParam(':Status', $Status);
            }
            if ($Salt != null) {
                $statement->bindParam(':Salt', $Salt);
            }
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? new Pengguna($result) : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());;
        }
    }



    public function insert(Pengguna $pengguna): bool
    {
        try {
            $sql = "INSERT INTO pengguna (ID_Pengguna, ID_Level, Nomor_Identitas, Password, Nama, Email, Nomor_HP, Foto, Status, Salt)
                    VALUES (:ID_Pengguna, :ID_Level, :Nomor_Identitas, :Password, :Nama, :Email, :Nomor_HP, :Foto, :Status, :Salt)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($pengguna->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(Pengguna $pengguna): bool
    {
        try {
            $sql = "UPDATE pengguna SET ID_Level = :ID_Level, Nomor_Identitas = :Nomor_Identitas, Password = :Password, Nama = :Nama, Email = :Email, Nomor_HP = :Nomor_HP, Foto = :Foto, Status = :Status, Salt = :Salt WHERE ID_Pengguna = :ID_Pengguna";
            $statement = $this->connection->prepare($sql);
            $statement->execute($pengguna->toArray());
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function updateStatus(string $ID_Pengguna, string $Status = 'AKTIF'): bool
    {
        try {
            $sql = "UPDATE pengguna SET Status = :Status WHERE ID_Pengguna = :ID_Pengguna";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':Status' => $Status,
                ':ID_Pengguna' => $ID_Pengguna
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteByField(string $fieldName, string $fieldValue): bool
    {
        try {
            $sql = "DELETE FROM pengguna WHERE $fieldName = :fieldValue";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':fieldValue' => $fieldValue]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaWithFilter(
        ?string $keyword = null,
        ?string $groupby = null,
        ?string $orderby = null,
        ?string $sort = 'ASC',
        ?int $limit = null,
        ?int $offset = null
    ): ?array {
        try {
            $sql = "SELECT * FROM pengguna WHERE 1";

            if ($keyword !== null) {
                $sql .= " AND (Nama LIKE :keyword OR Nomor_Identitas LIKE :keyword OR Email LIKE :keyword)";
                $keyword = "%$keyword%";
            }

            if ($groupby !== null) {
                $sql .= " GROUP BY $groupby";
            }

            if ($orderby !== null) {
                $sql .= " ORDER BY $orderby $sort";
            }

            if ($limit !== null) {
                $sql .= " LIMIT :limit";

                if ($offset !== null) {
                    $sql .= " OFFSET :offset";
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

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaWithLevel(
        ?string $ID_Pengguna = null,
        ?string $ID_Level = null,
        ?string $Nomor_Identitas = null,
        ?string $Password = null,
        ?string $Nama = null,
        ?string $Email = null,
        ?string $Nomor_HP = null,
        ?string $Foto = null,
        ?string $Status = null,
        ?string $Salt = null
    ): ?Pengguna {
        try {
            $sql = "
            SELECT * FROM pengguna
            INNER JOIN level ON pengguna.ID_Level = level.ID_Level
            WHERE 1
            ";
            if ($ID_Pengguna != null) {
                $sql .= " AND ID_Pengguna = :ID_Pengguna";
            }
            if ($ID_Level != null) {
                $sql .= " AND ID_Level = :ID_Level";
            }
            if ($Nomor_Identitas != null) {
                $sql .= " AND Nomor_Identitas = :Nomor_Identitas";
            }
            if ($Password != null) {
                $sql .= " AND Password = :Password";
            }
            if ($Nama != null) {
                $sql .= " AND Nama = :Nama";
            }
            if ($Email != null) {
                $sql .= " AND Email = :Email";
            }
            if ($Nomor_HP != null) {
                $sql .= " AND Nomor_HP = :Nomor_HP";
            }
            if ($Foto != null) {
                $sql .= " AND Foto = :Foto";
            }
            if ($Status != null) {
                $sql .= " AND Status = :Status";
            }
            if ($Salt != null) {
                $sql .= " AND Salt = :Salt";
            }
            $statement = $this->connection->prepare($sql);
            if ($ID_Pengguna != null) {
                $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            }
            if ($ID_Level != null) {
                $statement->bindParam(':ID_Level', $ID_Level);
            }
            if ($Nomor_Identitas != null) {
                $statement->bindParam(':Nomor_Identitas', $Nomor_Identitas);
            }
            if ($Password != null) {
                $statement->bindParam(':Password', $Password);
            }
            if ($Nama != null) {
                $statement->bindParam(':Nama', $Nama);
            }
            if ($Email != null) {
                $statement->bindParam(':Email', $Email);
            }
            if ($Nomor_HP != null) {
                $statement->bindParam(':Nomor_HP', $Nomor_HP);
            }
            if ($Foto != null) {
                $statement->bindParam(':Foto', $Foto);
            }
            if ($Status != null) {
                $statement->bindParam(':Status', $Status);
            }
            if ($Salt != null) {
                $statement->bindParam(':Salt', $Salt);
            }
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                $pengguna = new Pengguna($result[0]);
                $pengguna->Level = $this->levelRepository->get($pengguna->getLevelID());
            }
            return $result ? $pengguna : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
