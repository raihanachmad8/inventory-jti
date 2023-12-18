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

    public function getPenggunaById($id) : Pengguna
    {
        $query = "SELECT P.ID_Pengguna, P.Nama as Nama_Pengguna, P.Nomor_Identitas, L.ID_Level FROM pengguna P
        INNER JOIN Level L ON P.ID_Level = L.ID_Level
        WHERE ID_Pengguna = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $pengguna = $statement->fetchObject('Pengguna');

        return $pengguna;
    }

    public function getDetailPenggunaById(string $id) : Pengguna
    {
        try {
            $query = "SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, Password, ID_Level, Status, Email, No_HP, Foto FROM pengguna WHERE ID_Pengguna = :id";
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

    public function create(Pengguna $pengguna) :bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO pengguna (ID_Pengguna, ID_Level, Nomor_Identitias, Nama, Password, Email, No_HP, Foto, Status, Salt) VALUES (:id, :id_level, :nomor_identitas, :nama_pengguna, :password, :email, :no_hp, :foto, :status, :salt)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'id_level' => $pengguna->ID_Level,
                'nomor_identitas' => $pengguna->Nomor_Identitas,
                'nama_pengguna' => $pengguna->Nama_Pengguna,
                'password' => $pengguna->Password,
                'email' => $pengguna->Email,
                'no_hp' => $pengguna->No_HP,
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

    public function update(Pengguna $pengguna) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE pengguna SET ID_Level = :id_level, Nomor_Identitas = :nomor_identitas, Nama = :nama_pengguna, Password = :password, Email = :email, No_HP = :no_hp, Foto = :foto, Status = :status, Salt = :salt WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $pengguna->ID_Pengguna,
                'id_level' => $pengguna->ID_Level,
                'nomor_identitas' => $pengguna->Nomor_Identitas,
                'nama_pengguna' => $pengguna->Nama_Pengguna,
                'password' => $pengguna->Password,
                'email' => $pengguna->Email,
                'no_hp' => $pengguna->No_HP,
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
}

