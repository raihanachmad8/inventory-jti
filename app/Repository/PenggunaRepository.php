<?php

require_once __DIR__ . '/../Models/Pengguna.php';

class PenggunaRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListPengguna() : array
    {
        $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status FROM pengguna";
        $result = $this->connection->query($query);
        $pengguna = [];
        while ($row = $result->fetchObject('Pengguna')) {
            $pengguna[] = $row;
        }
        return $pengguna;
    }

    public function getPenggunaById($id) : ?Pengguna
    {
        try {
            $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status, Email FROM pengguna WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $pengguna = $statement->fetchObject('Pengguna');

            return $pengguna ?? null;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getDetailPenggunaById(string $id) : Pengguna
    {
        try {
            $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status, Email, Nomor_HP, Foto, Salt FROM pengguna WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $pengguna = $statement->fetchObject('Pengguna');

            return $pengguna;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getDetailPenggunaByEmail(string $Email) : Pengguna
    {
        try {
            $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status, Email, Nomor_HP, Foto, Salt FROM pengguna WHERE Email = :Email";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'Email' => $Email
            ]);
            $pengguna = $statement->fetchObject('Pengguna');

            return $pengguna;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function create(Pengguna $pengguna) :bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO pengguna (ID_Pengguna, ID_Level,  Nomor_Identitas, Nama, Password, Email, Nomor_HP, Foto, Status, Salt) VALUES (:id, :id_level, :nomor_identitas, :nama_pengguna, :password, :email, :Nomor_HP, :foto, :status, :salt)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'id_level' => $pengguna->ID_Level,
                'nomor_identitas' => $pengguna->Nomor_Identitas,
                'nama_pengguna' => $pengguna->Nama_Pengguna,
                'password' => $pengguna->Password,
                'email' => $pengguna->Email,
                'Nomor_HP' => $pengguna->Nomor_HP,
                'foto' => $pengguna->Foto,
                'status' => $pengguna->Status,
                'salt' => $pengguna->Salt
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
    public function updateProfile(Pengguna $pengguna) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE pengguna SET Nama = :nama_pengguna, Foto = :foto WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'nama_pengguna' => $pengguna->Nama_Pengguna,
                'foto' => $pengguna->Foto,
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
    public function updateAccountInformation(Pengguna $pengguna) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE pengguna SET Email = :email, Nomor_HP = :Nomor_HP WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'email' => $pengguna->Email,
                'Nomor_HP' => $pengguna->Nomor_HP,
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
    public function updateAccountSecurity(Pengguna $pengguna) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE pengguna SET Password = :password,  Salt = :salt WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'password' => $pengguna->Password,
                'salt' => $pengguna->Salt
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
            $query = "DELETE FROM pengguna WHERE ID_Pengguna = :id";
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
        $query = "SELECT ID_Pengguna
        FROM pengguna
        ORDER BY CAST(SUBSTRING(ID_Pengguna FROM 2) AS SIGNED) DESC, ID_Pengguna
        LIMIT 1";
        $result = $this->connection->query($query);
        $pengguna = $result->fetch(PDO::FETCH_ASSOC);

        return $pengguna['ID_Pengguna'];
    }

    public function search($keyword = '') : array
    {
        $query = "SELECT ID_Pengguna, Nomor_Identitas, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status FROM pengguna WHERE ID_Pengguna LIKE :keyword OR Nama_Pengguna LIKE :keyword OR Nomor_Identitas LIKE :keyword OR Password LIKE :keyword OR ID_Level LIKE :keyword OR Status LIKE :keyword";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'keyword' => "%$keyword%"
        ]);
        $pengguna = [];
        while ($row = $statement->fetchObject('Pengguna')) {
            $pengguna[] = $row;
        }
        return $pengguna;
    }

    public function deleteByField(string $fieldName, string $fieldValue): bool
    {
        try {
            $sql = "DELETE FROM pengguna WHERE $fieldName = :fieldValue AND Status = 'TIDAK AKTIF'";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':fieldValue' => $fieldValue]);
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaByEmail(string $Email) : ?Pengguna {
        try {
            $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status, Email FROM pengguna WHERE Email = :Email";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'Email' => $Email
            ]);
            $pengguna = $statement->fetchObject('Pengguna');
            return $pengguna ? $pengguna : null;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
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
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaByNomorIdentitas(string $Nomor_Identitas): ?Pengguna
    {
        try {
            $sql = "SELECT * FROM pengguna WHERE Nomor_Identitas = :Nomor_Identitas";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                'Nomor_Identitas' => $Nomor_Identitas
            ]);
            $result = $statement->fetchObject('Pengguna');
            if (!$result) {
                return null;
            }
            return $result;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

