
<?php
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
            DB::connect()->beginTransaction();
            $sql = "INSERT INTO OTP (ID_OTP, ID_Pengguna, Kode, Expired) VALUES (:idOTP, :userId, :otpCode, DATE_ADD(NOW(), INTERVAL 5 MINUTE))";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':idOTP', base64_encode(random_bytes(4). '-' . base64_encode(random_bytes(8))));
            $statement->bindParam(':userId', $userId);
            $statement->bindParam(':otpCode', $otpCode);
            $statement->execute();
            DB::connect()->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $e) {
            DB::connect()->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function getOTP(string $userId, string $otpCode): ?array
    {
        try {
            $this->deleteExpiredOTP();

            $sql = "SELECT * FROM OTP WHERE ID_Pengguna = :userId AND Kode = :otpCode";
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':userId', $userId);
            $statement->bindParam(':otpCode', $otpCode);
            $statement->execute();

            $otp = $statement->fetch(PDO::FETCH_ASSOC);
            return $otp ? $otp : null;
        } catch (PDOException $e) {
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
        }
    }
}
