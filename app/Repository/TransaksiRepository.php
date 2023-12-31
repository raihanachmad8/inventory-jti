<?php

require_once __DIR__ . "/../Models/Transaksi.php";

class TransaksiRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListTransaksi() : array
    {
        $query = "SELECT ID_Transaksi, ID_Pengguna, ID_Admin, StartDate, EndDate, Deskripsi_Keperluan, Jaminan, Pesan, ID_Status FROM transaksi";
        $result = $this->connection->query($query);
        $transaksi = [];
        while ($row = $result->fetchObject('Transaksi')) {
            $message = $row->Pesan;
            $lastSeparatorPosition = strrpos($message, "||");
            $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
            $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
            $row->Pesan = $firstPart;
            $row->Timestamp = $secondPart;
            $transaksi[] = $row;
        }
        return $transaksi;
    }

    public function getTransaksiById(string $ID_Transaksi): Transaksi
    {
        $this->changeExpiredStatus();
        $query = "SELECT ID_Transaksi, ID_Pengguna, ID_Admin, StartDate, EndDate, Deskripsi_Keperluan, Jaminan, Pesan, ID_Status FROM transaksi WHERE ID_Transaksi = :id";
        $statement = $this->connection->prepare($query);
        $statement->execute([
            'id' => $ID_Transaksi
        ]);
        $transaksi = $statement->fetchObject('Transaksi');
        $message = $transaksi->Pesan;
        $lastSeparatorPosition = strrpos($message, "||");
        $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
        $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
        $transaksi->Pesan = $firstPart;
        $transaksi->Timestamp = $secondPart;

        return $transaksi;
    }

    public function create(Transaksi $transaksi)
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO transaksi (ID_Transaksi, ID_Pengguna, ID_Admin, ID_Status, StartDate, EndDate, Deskripsi_Keperluan, Jaminan, Pesan) VALUES (:id, :id_pengguna, :id_admin, :id_status, :start_date, :end_date, :deskripsi_keperluan, :jaminan, :pesan)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $transaksi->ID_Transaksi,
                'id_pengguna' => $transaksi->ID_Pengguna,
                'id_admin' => $transaksi->ID_Admin,
                'id_status' => $transaksi->ID_Status,
                'start_date' => $transaksi->StartDate,
                'end_date' => $transaksi->EndDate,
                'deskripsi_keperluan' => $transaksi->Deskripsi_Keperluan,
                'jaminan' => $transaksi->Jaminan,
                'pesan' => $transaksi->Pesan
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function updateDataPeminjaman(string $ID_transaksi, string $ID_Admin, string $ID_Status, string $Pesan) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE transaksi SET ID_Admin = :id_admin, ID_Status = :id_status, Pesan = :pesan WHERE ID_Transaksi = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_transaksi,
                'id_admin' => $ID_Admin,
                'id_status' => $ID_Status,
                'pesan' => $Pesan
            ]);

            $this->connection->commit();
            return true;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function update(Transaksi $transaksi) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE transaksi SET ID_Pengguna = :id_pengguna, ID_Admin = :id_admin, StartDate = :start_date, EndDate = :end_date, Deskripsi_Keperluan = :deskripsi_keperluan, Jaminan = :jaminan, Pesan = :pesan, Status = :status WHERE ID_Transaksi = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $transaksi->ID_Transaksi,
                'id_pengguna' => $transaksi->ID_Pengguna,
                'id_admin' => $transaksi->ID_Admin,
                'start_date' => $transaksi->StartDate,
                'end_date' => $transaksi->EndDate,
                'deskripsi_keperluan' => $transaksi->Deskripsi_Keperluan,
                'jaminan' => $transaksi->Jaminan,
                'pesan' => $transaksi->Pesan,
                'status' => $transaksi->Status
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function delete(string $ID_Transaksi) {
        try {
            $this->connection->beginTransaction();
            $query = "DELETE FROM transaksi WHERE ID_Transaksi = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_Transaksi
            ]);

            $this->connection->commit();
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function getLastId() : string
    {
        $query = "SELECT ID_Transaksi
        FROM transaksi
        ORDER BY CAST(SUBSTRING(ID_Transaksi FROM 2) AS SIGNED) DESC, ID_Transaksi
        LIMIT 1";
        $result = $this->connection->query($query);
        $transaksi = $result->fetch(PDO::FETCH_ASSOC);

        return $transaksi['ID_Transaksi'];
    }

    public function search(string $keyword = '') : array
    {
        try {
            $query = "
            SELECT T.ID_Transaksi, T.ID_Pengguna, T.ID_Admin, T.StartDate, T.EndDate, T.Deskripsi_Keperluan, T.Jaminan, T.Pesan, T.ID_Status FROM transaksi T
            INNER JOIN pengguna p ON T.ID_Pengguna = p.ID_Pengguna
            INNER JOIN status s ON T.ID_Status = s.ID_Status
            INNER JOIN maintainer a on T.ID_Admin = a.ID_Maintainer
            INNER JOIN DetailTransaksi dt on T.ID_Transaksi = dt.ID_Transaksi
            WHERE dt.ID_Transaksi  AND ID_Transaksi LIKE :keyword OR ID_Pengguna LIKE :keyword OR ID_Admin LIKE :keyword OR StartDate LIKE :keyword OR EndDate LIKE :keyword OR Deskripsi_Keperluan LIKE :keyword OR Jaminan LIKE :keyword OR Pesan LIKE :keyword OR ID_Status LIKE :keyword";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'keyword' => "%$keyword%"
            ]);
            while ($row = $statement->fetchObject('Transaksi')) {
                $message = $row->Pesan;
                $lastSeparatorPosition = strrpos($message, "||");
                $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
                $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
                $row->Pesan = $firstPart;
                $row->Timestamp = $secondPart;
                $transaksi[] = $row;
            }

            return $transaksi ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListTransaksiByStatus(array $status) : array
    {
        try {
            $query = "
            SELECT T.ID_Transaksi, T.ID_Pengguna, T.ID_Admin, T.StartDate, T.EndDate, T.Deskripsi_Keperluan, T.Jaminan, T.Pesan, T.ID_Status FROM transaksi T
            INNER JOIN pengguna p ON T.ID_Pengguna = p.ID_Pengguna
            INNER JOIN status s ON T.ID_Status = s.ID_Status
            INNER JOIN maintainer a on T.ID_Admin = a.ID_Maintainer
            WHERE s.Nama IN (";
            $i = 0;
            foreach ($status as $stat) {
                $query .= ":status$i, ";
                $i++;
            }
            $query = substr($query, 0, -2);
            $query .= ")";
            $statement = $this->connection->prepare($query);
            $i = 0;
            foreach ($status as $stat) {
                $statement->bindValue(":status$i", $stat);
                $i++;
            }
            $statement->execute();

            while ($row = $statement->fetchObject('Transaksi')) {
                $message = $row->Pesan;
                $lastSeparatorPosition = strrpos($message, "||");
                $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
                $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
                $row->Pesan = $firstPart;
                $row->Timestamp = $secondPart;
                $transaksi[] = $row;
            }

            return $transaksi;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function searchListTransaksiByStatus(array $statusCode, string $keyword = '', string $ID_Pengguna = null) : array
    {
        try {
            $query = "
            SELECT T.ID_Transaksi, T.ID_Pengguna, T.ID_Admin, T.StartDate, T.EndDate, T.Deskripsi_Keperluan, T.Jaminan, T.Pesan, T.ID_Status
            FROM transaksi T
            LEFT JOIN pengguna P ON T.ID_Pengguna = P.ID_Pengguna
            LEFT JOIN Level L ON P.ID_Level = L.ID_Level
            LEFT JOIN status S ON T.ID_Status = S.ID_Status
            LEFT JOIN maintainer A ON T.ID_Admin = A.ID_Maintainer
            WHERE S.ID_Status IN (";

        $i = 0;
        foreach ($statusCode as $stat) {
            $query .= ":status$i, ";
            $i++;
        }
        $query = rtrim($query, ', ');  // Remove the trailing comma and space
        $query .= ") AND (P.Nomor_Identitas LIKE :keyword OR L.Nama LIKE :keyword OR P.Nama LIKE :keyword OR A.Nama LIKE :keyword OR T.StartDate LIKE :keyword OR T.EndDate LIKE :keyword )";
        if ($ID_Pengguna != null) {
            $query .= " AND T.ID_Pengguna = :ID_Pengguna";
        }
        $query .= " ORDER BY CAST(SUBSTRING(T.ID_Transaksi FROM 2) AS SIGNED) DESC, T.ID_Transaksi";
        $statement = $this->connection->prepare($query);

        $i = 0;
        foreach ($statusCode as $stat) {
            $statement->bindValue(":status$i", $stat);
            $i++;
        }

        $statement->bindValue(':keyword', "%$keyword%");  // Bind the keyword outside of the loop
        if ($ID_Pengguna != null) {
            $statement->bindValue(':ID_Pengguna', $ID_Pengguna);
        }
        $statement->execute();

        while ($row = $statement->fetchObject('Transaksi')) {
            $message = $row->Pesan;
            $lastSeparatorPosition = strrpos($message, "||");
            $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
            $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
            $row->Pesan = $firstPart;
            $row->Timestamp = $secondPart;
            $transaksi[] = $row;
        }
        return $transaksi ?? [];

        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
    public function searchListRiwayatTransaksiByStatus(array $statusCode, string $keyword = '', string $ID_Pengguna = null) : array
    {
        try {
            $this->changeExpiredStatus();
            $query = "
            SELECT T.ID_Transaksi, T.ID_Pengguna, T.ID_Admin, T.StartDate, T.EndDate, T.Deskripsi_Keperluan, T.Jaminan, T.Pesan, T.ID_Status
            FROM transaksi T
            LEFT JOIN pengguna P ON T.ID_Pengguna = P.ID_Pengguna
            LEFT JOIN Level L ON P.ID_Level = L.ID_Level
            LEFT JOIN status S ON T.ID_Status = S.ID_Status
            LEFT JOIN maintainer A ON T.ID_Admin = A.ID_Maintainer
            WHERE S.ID_Status IN (";

        $i = 0;
        foreach ($statusCode as $stat) {
            $query .= ":status$i, ";
            $i++;
        }
        $query = rtrim($query, ', ');  // Remove the trailing comma and space
        $query .= ") AND (P.Nomor_Identitas LIKE :keyword OR L.Nama LIKE :keyword OR P.Nama LIKE :keyword OR A.Nama LIKE :keyword OR T.StartDate LIKE :keyword OR T.EndDate LIKE :keyword )";
        if ($ID_Pengguna != null) {
            $query .= " AND T.ID_Pengguna = :ID_Pengguna";
        }
        $query .= " ORDER BY CAST(SUBSTRING(T.ID_Transaksi FROM 2) AS SIGNED) DESC, T.ID_Transaksi";
        $statement = $this->connection->prepare($query);

        $i = 0;
        foreach ($statusCode as $stat) {
            $statement->bindValue(":status$i", $stat);
            $i++;
        }

        $statement->bindValue(':keyword', "%%");  // Bind the keyword outside of the loop
        if ($ID_Pengguna != null) {
            $statement->bindValue(':ID_Pengguna', $ID_Pengguna);
        }
        $statement->execute();

        while ($row = $statement->fetchObject('Transaksi')) {
            $message = $row->Pesan;
            $lastSeparatorPosition = strrpos($message, "||");
            $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
            $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
            $row->Pesan = $firstPart;
            $row->Timestamp = $secondPart;
            $transaksi[] = $row;
        }
        return $transaksi ?? [];

        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }





    public function countStatusTransaksi(array $statusCodes, string $ID_Pengguna = null) : array
    {
        try {
            $statusMapping = [
                'S1' => 'Menunggu',
                'S2' => 'Ditolak',
                'S3' => 'Diterima',
                'S4' => 'Proses',
                'S5' => 'Selesai',
                'S6' => 'Dibatalkan',
                'S7' => 'Menunggu Ganti'
            ];

            $result = [];

            foreach ($statusCodes as $statusCode) {
                // Get the corresponding status name from the mapping
                $statusName = $statusMapping[$statusCode] ?? null;

                if ($statusName) {
                    $query = "
                        SELECT COALESCE(COUNT(*), 0) as count FROM transaksi
                        LEFT JOIN status ON transaksi.ID_Status = status.ID_Status
                        WHERE status.Nama = :status";

                    if ($ID_Pengguna !== null) {
                        $query .= " AND transaksi.ID_Pengguna = :ID_Pengguna";
                    }

                    $statement = $this->connection->prepare($query);
                    $statement->bindValue('status', $statusName);

                    if ($ID_Pengguna !== null) {
                        $statement->bindValue('ID_Pengguna', $ID_Pengguna);
                    }

                    $statement->execute();
                    $count = $statement->fetch(PDO::FETCH_ASSOC)['count'];

                    // Add the result to the mapped status name
                    $result[$statusName] = $count;
                }
            }
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function avaibleStok() : array
    {
        try {
            $query = "
            SELECT
                i.ID_Inventaris,
                SUM(dt.Jumlah) AS TotalBorrowed
            FROM
                Transaksi t
            JOIN
                DetailTransaksi dt ON t.ID_Transaksi = dt.ID_Transaksi
            JOIN
                Inventaris i ON dt.ID_Inventaris = i.ID_Inventaris
            JOIN
                Status s ON t.ID_Status = s.ID_Status
            WHERE
                t.ID_Status NOT IN ('S2', 'S5', 'S6')
            GROUP BY
                t.ID_Status, i.ID_Inventaris
            ORDER BY
                i.ID_Inventaris;";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $barang[] = $row;
            }

            return $barang ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function batalkanPeminjaman(string $ID_Transaksi) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE transaksi SET ID_Status = 'S6' WHERE ID_Transaksi = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_Transaksi
            ]);

            $this->connection->commit();
            return true;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    public function getListPesan(string $ID_Pengguna) : array {
        try {
            $query = "SELECT ID_Transaksi, Pesan FROM transaksi WHERE ID_Pengguna = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_Pengguna
            ]);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $message = $row['Pesan'];
                $lastSeparatorPosition = strrpos($message, "||");
                $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
                $secondPart = trim(substr($message, $lastSeparatorPosition + strlen("||")));
                $row['Pesan'] = $firstPart;
                $row['Timestamp'] = $secondPart;
                $pesan[] = $row;
            }

            return $pesan ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListDate(string $ID_Pengguna) : array {
        try {
            $query = "SELECT ID_Transaksi, StartDate, EndDate FROM transaksi WHERE ID_Pengguna = :id AND ID_Status = 'S4'";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_Pengguna
            ]);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
            return $result ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function changeExpiredStatus(string $ID_Pengguna = null)
    {
        try {
            $this->connection->beginTransaction();
            $query = "UPDATE transaksi SET ID_Status = 'S2' WHERE ID_Status = 'S1' AND StartDate < NOW() + INTERVAL 10 MINUTE;";
            if (!empty($ID_Pengguna)) {
                $query .= " AND ID_Pengguna = :id";
            }
            $statement = $this->connection->prepare($query);
            if (!empty($ID_Pengguna)) {
                $statement->bindParam('id', $ID_Pengguna);
            }
            $statement->execute();

            $query = "UPDATE transaksi SET ID_Status = 'S2' WHERE ID_Status = 'S3' AND EndDate < NOW() - INTERVAL 10 MINUTE;";
            if (!empty($ID_Pengguna)) {
                $query .= " AND ID_Pengguna = :id";
            }
            $statement = $this->connection->prepare($query);
            if (!empty($ID_Pengguna)) {
                $statement->bindParam('id', $ID_Pengguna);
            }
            $statement->execute();


            $this->connection->commit();
            return true;
        } catch (PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
}
