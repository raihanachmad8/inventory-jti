
<?php
require_once __DIR__ . '/../Models/OTP.php';
class OTPRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createOTP(string $userId, string $otpCode): bool
    {
        try {

            $id = base64_encode(random_bytes(4). '-' . base64_encode(random_bytes(8)));
            $sql = "INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES (:idOTP, :userId, :otpCode, DATE_ADD(NOW(), INTERVAL 5 MINUTE))";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':idOTP', $id);
            $statement->bindParam(':userId', $userId);
            $statement->bindParam(':otpCode', $otpCode);
            $statement->execute();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOTP(string $ID_Pengguna, string $Kode): ?OTP
    {
        try {
            $this->deleteExpiredOTP();
            $sql = "SELECT * FROM OTP WHERE ID_Pengguna = :ID_Pengguna AND Kode = :Kode AND Expired > NOW()";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            $statement->bindParam(':Kode', $Kode);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result ? new OTP($result) : null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteOTP(string $userId): bool
    {
        try {
            $sql = "DELETE FROM OTP WHERE ID_Pengguna = :userId";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':userId', $userId);
            $statement->execute();

            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteExpiredOTP(): bool
    {
        try {
            $sql = "DELETE FROM OTP WHERE Expired < NOW()";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteAllOTP(string $userId): bool
    {
        try {
            $sql = "DELETE FROM OTP WHERE ID_Pengguna = :userId";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':userId', $userId);
            $statement->execute();

            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOTPByIdPengguna(string $ID_Pengguna): ?OTP
    {
        try {
            $this->deleteExpiredOTP();
            $sql = "SELECT * FROM OTP WHERE ID_Pengguna = :ID_Pengguna AND Expired > NOW()";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                throw new Exception('OTP not found.');
            }
            $otp = new OTP($result);
            return $otp ?? null;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
