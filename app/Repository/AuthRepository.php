<?php

require_once __DIR__ . "/../Models/User.php";

class AuthRepository {
    private ?PDO $connection = null;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getUserById(string $id) : ?User
    {
        try {
            $sql = "SELECT * FROM Pengguna WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':id' => $id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            $user = new User([
                'id_pengguna' => $result['ID_Pengguna'],
                'id_level' => $result['ID_Level'],
                'nomor_identitas' => $result['Username'],
                'password' => $result['Password'],
                'nama' => $result['Nama'],
                'email' => $result['Email'],
                'nomor_hp' => $result['Nomor_HP'],
                'foto' => $result['Foto']
            ]);
            return $user;
        }  catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserByNomorIdentitas(string $nomor_identitas) : ?User
    {
        try {
            $sql = "SELECT * FROM pengguna WHERE Username = :nomor_identitas";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':nomor_identitas' => $nomor_identitas]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            $user = new User([
                'id_pengguna' => $result['ID_Pengguna'],
                'id_level' => $result['ID_Level'],
                'nomor_identitas' => $result['Username'],
                'password' => $result['Password'],
                'nama' => $result['Nama'],
                'email' => $result['Email'],
                'nomor_hp' => $result['Nomor_HP'],
                'foto' => $result['Foto']
            ]);

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserByEmail(string $email) : ?User
    {
        try {
            $sql = "SELECT * FROM pengguna WHERE email = :email";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':email' => $email]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                return null;
            }
            $user = new User([
                'id_pengguna' => $result['ID_Pengguna'],
                'id_level' => $result['ID_Level'],
                'nomor_identitas' => $result['Username'],
                'password' => $result['Password'],
                'nama' => $result['Nama'],
                'email' => $result['Email'],
                'nomor_hp' => $result['Nomor_HP'],
                'foto' => $result['Foto']
            ]);

            return $user;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function getLevelById(string $level) : ?string {

        try {
            $sql = "SELECT * FROM level WHERE ID_Level = :level";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                ':level' => $level
            ]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['ID_Level'];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function create(User $data) : ?User
    {
        try {
            $levelId = $this->getLevelById($data->id_level);
            $id = 'Account_ID_'. $data->nomor_identitas;
            $sql = "INSERT INTO pengguna (ID_Pengguna, ID_Level, Username, Password, Nama, Email, Nomor_HP, Foto)
                    VALUES (:idPengguna, :levelId, :nomor_identitas, :password, :nama, :email, :nomorHp, :foto)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                'idPengguna' => $id,
                'levelId' => $levelId,
                'nomor_identitas' => $data->nomor_identitas,
                'password' => $data->password,
                'nama' => $data->nama,
                'email' => $data->email,
                'nomorHp' => $data->nomor_hp,
                'foto' => $data->foto
            ]);
            $user = $this->getUserByEmail($data->email);

            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(User $data) : ?User
    {
        try {
            DB::connect()->beginTransaction();
            $sql = "UPDATE pengguna SET ID_Level = :idLevel, Username = :nomor_identitas, Password = :password, Nama = :nama, Email = :email, Nomor_HP = :nomorHp, Foto = :foto WHERE ID_Pengguna = :idPengguna";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                'idLevel' => $data->id_level,
                'nomor_identitas' => $data->nomor_identitas,
                'password' => $data->password,
                'nama' => $data->nama,
                'email' => $data->email,
                'nomorHp' => $data->nomor_hp,
                'foto' => $data->foto,
                'idPengguna' => $data->id_pengguna
            ]);
            $user = $this->getUserById($data->id_pengguna);
            DB::connect()->commit();
            return $user ?? null;
        } catch (Exception $e) {
            DB::connect()->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $id) : bool
    {
        try {
            DB::connect()->beginTransaction();
            $sql = "DELETE FROM pengguna WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($sql);
            $statement->execute([':id' => $id]);
            DB::connect()->commit();
            return true;
        } catch (Exception $e) {
            DB::connect()->rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
