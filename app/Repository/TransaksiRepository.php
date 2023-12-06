<?php

require_once __DIR__ . '/../Models/Pengguna.php';
require_once __DIR__ . '/../Models/Status.php';
require_once __DIR__ . '/../Models/Inventaris.php';
require_once __DIR__ . '/../Models/Transaksi.php';
require_once __DIR__ . '/../Models/DetailTransaksi.php';

class TransaksiRepository
{
    private PDO $connection;
    private InventarisRepository $InventarisRepository;
    private PenggunaRepository $PenggunaRepository;
    private StatusRepository $StatusRepository;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->InventarisRepository = new InventarisRepository($connection);

    }
    public function get(
        ?string $ID_Transaksi = null,
        ?string $ID_Pengguna = null,
        ?string $ID_Admin = null,
        ?string $ID_Status = null,
        ?string $StartDate = null,
        ?string $EndDate = null,
        ?string $Deskripsi_Keperluan = null,
        ?string $Jaminan = null,
        ?string $Pesan = null
    ) {
        try {
            $sql = "SELECT * FROM transaksi";
            if ($ID_Transaksi !== null || $ID_Pengguna !== null || $ID_Admin !== null || $ID_Status !== null || $StartDate !== null || $EndDate !== null || $Deskripsi_Keperluan !== null || $Jaminan !== null || $Pesan !== null) {
                $sql .= "";
            }
            if ($ID_Transaksi !== null) {
                $sql .= " ID_Transaksi = :ID_Transaksi";
            }

            if ($ID_Pengguna !== null) {
                $sql .= " ID_Pengguna = :ID_Pengguna";
            }

            if ($ID_Admin !== null) {
                $sql .= " ID_Admin = :ID_Admin";
            }

            if ($ID_Status !== null) {
                $sql .= " ID_Status = :ID_Status";
            }

            if ($StartDate !== null) {
                $sql .= " StartDate = :StartDate";
            }

            if ($EndDate !== null) {
                $sql .= " EndDate = :EndDate";
            }

            if ($Deskripsi_Keperluan !== null) {
                $sql .= " Deskripsi_Keperluan = :Deskripsi_Keperluan";
            }

            if ($Jaminan !== null) {
                $sql .= " Jaminan = :Jaminan";
            }

            if ($Pesan !== null) {
                $sql .= " Pesan = :Pesan";
            }

            $statement = $this->connection->prepare($sql);

            if ($ID_Transaksi !== null) {
                $statement->bindParam(':ID_Transaksi', $ID_Transaksi);
            }

            if ($ID_Pengguna !== null) {
                $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            }

            if ($ID_Admin !== null) {
                $statement->bindParam(':ID_Admin', $ID_Admin);
            }

            if ($ID_Status !== null) {
                $statement->bindParam(':ID_Status', $ID_Status);
            }

            if ($StartDate !== null) {
                $statement->bindParam(':StartDate', $StartDate);
            }

            if ($EndDate !== null) {
                $statement->bindParam(':EndDate', $EndDate);
            }

            if ($Deskripsi_Keperluan !== null) {
                $statement->bindParam(':Deskripsi_Keperluan', $Deskripsi_Keperluan);
            }

            if ($Jaminan !== null) {
                $statement->bindParam(':Jaminan', $Jaminan);
            }

            if ($Pesan !== null) {
                $statement->bindParam(':Pesan', $Pesan);
            }

            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result ? new Transaksi($result) : null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTransactionWithDetail(
        ?string $ID_Transaksi = null,
        ?string $ID_Pengguna = null,
        ?string $ID_Admin = null,
        ?string $ID_Status = null,
        ?string $StartDate = null,
        ?string $EndDate = null,
        ?string $Deskripsi_Keperluan = null,
        ?string $Jaminan = null,
        ?string $Pesan = null
    ) {
        try {
            $sql = "
            SELECT * FROM transaksi
            INNER JOIN inventaris ON detail_transaksi.ID_Inventaris = inventaris.ID_Inventaris
            INNER JOIN pengguna ON transaksi.ID_Pengguna = pengguna.ID_Pengguna
            INNER JOIN admin ON transaksi.ID_Admin = admin.ID_Admin
            INNER JOIN status ON transaksi.ID_Status = status.ID_Status
            ";

            if ($ID_Transaksi !== null || $ID_Pengguna !== null || $ID_Admin !== null || $ID_Status !== null || $StartDate !== null || $EndDate !== null || $Deskripsi_Keperluan !== null || $Jaminan !== null || $Pesan !== null) {
                $sql .= " WHERE";
            }

            if ($ID_Transaksi !== null) {
                $sql .= " transaksi.ID_Transaksi = :ID_Transaksi";
            }

            if ($ID_Pengguna !== null) {
                $sql .= " transaksi.ID_Pengguna = :ID_Pengguna";
            }

            if ($ID_Admin !== null) {
                $sql .= " ID_Admin = :ID_Admin";
            }

            if ($ID_Status !== null) {
                $sql .= " ID_Status = :ID_Status";
            }

            if ($StartDate !== null) {
                $sql .= " StartDate = :StartDate";
            }

            if ($EndDate !== null) {
                $sql .= " EndDate = :EndDate";
            }

            if ($Deskripsi_Keperluan !== null) {
                $sql .= " Deskripsi_Keperluan = :Deskripsi_Keperluan";
            }

            if ($Jaminan !== null) {
                $sql .= " Jaminan = :Jaminan";
            }

            if ($Pesan !== null) {
                $sql .= " Pesan = :Pesan";
            }

            $statement = $this->connection->prepare($sql);

            if ($ID_Transaksi !== null) {
                $statement->bindParam(':ID_Transaksi', $ID_Transaksi);
            }

            if ($ID_Pengguna !== null) {
                $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            }

            if ($ID_Admin !== null) {
                $statement->bindParam(':ID_Admin', $ID_Admin);
            }

            if ($ID_Status !== null) {
                $statement->bindParam(':ID_Status', $ID_Status);
            }

            if ($StartDate !== null) {
                $statement->bindParam(':StartDate', $StartDate);
            }

            if ($EndDate !== null) {
                $statement->bindParam(':EndDate', $EndDate);
            }

            if ($Deskripsi_Keperluan !== null) {
                $statement->bindParam(':Deskripsi_Keperluan', $Deskripsi_Keperluan);
            }

            if ($Jaminan !== null) {
                $statement->bindParam(':Jaminan', $Jaminan);
            }

            if ($Pesan !== null) {
                $statement->bindParam(':Pesan', $Pesan);
            }

            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $transaction = new Transaksi($result);
                $transaction->pengguna = $this->PenggunaRepository->get($transaction->getID());
                $transaction->admin = $this->PenggunaRepository->get($transaction->getID());
                $transaction->status = $this->StatusRepository->get($transaction->getID());
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function getTransactionList(
        ?string $ID_Transaksi = null,
        ?string $ID_Pengguna = null,
        ?string $ID_Admin = null,
        ?string $ID_Status = null,
        ?string $StartDate = null,
        ?string $EndDate = null,
        ?string $Deskripsi_Keperluan = null,
        ?string $Jaminan = null,
        ?string $Pesan = null
    ) {
        try {
            $sql = "SELECT * FROM transaksi";
            if ($ID_Transaksi !== null || $ID_Pengguna !== null || $ID_Admin !== null || $ID_Status !== null || $StartDate !== null || $EndDate !== null || $Deskripsi_Keperluan !== null || $Jaminan !== null || $Pesan !== null) {
                $sql .= " WHERE";
            }

            if ($ID_Transaksi !== null) {
                $sql .= " ID_Transaksi = :ID_Transaksi";
            }

            if ($ID_Pengguna !== null) {
                $sql .= " ID_Pengguna = :ID_Pengguna";
            }

            if ($ID_Admin !== null) {
                $sql .= " ID_Admin = :ID_Admin";
            }

            if ($ID_Status !== null) {
                $sql .= " ID_Status = :ID_Status";
            }

            if ($StartDate !== null) {
                $sql .= " StartDate = :StartDate";
            }

            if ($EndDate !== null) {
                $sql .= " EndDate = :EndDate";
            }

            if ($Deskripsi_Keperluan !== null) {
                $sql .= " Deskripsi_Keperluan = :Deskripsi_Keperluan";
            }

            if ($Jaminan !== null) {
                $sql .= " Jaminan = :Jaminan";
            }

            if ($Pesan !== null) {
                $sql .= " Pesan = :Pesan";
            }

            $statement = $this->connection->prepare($sql);

            if ($ID_Transaksi !== null) {
                $statement->bindParam(':ID_Transaksi', $ID_Transaksi);
            }

            if ($ID_Pengguna !== null) {
                $statement->bindParam(':ID_Pengguna', $ID_Pengguna);
            }

            if ($ID_Admin !== null) {
                $statement->bindParam(':ID_Admin', $ID_Admin);
            }

            if ($ID_Status !== null) {
                $statement->bindParam(':ID_Status', $ID_Status);
            }

            if ($StartDate !== null) {
                $statement->bindParam(':StartDate', $StartDate);
            }

            if ($EndDate !== null) {
                $statement->bindParam(':EndDate', $EndDate);
            }

            if ($Deskripsi_Keperluan !== null) {
                $statement->bindParam(':Deskripsi_Keperluan', $Deskripsi_Keperluan);
            }

            if ($Jaminan !== null) {
                $statement->bindParam(':Jaminan', $Jaminan);
            }

            if ($Pesan !== null) {
                $statement->bindParam(':Pesan', $Pesan);
            }

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $transactionList = [];

            foreach ($result as $transaction) {
                $transactionList[] = new Transaksi($transaction);
            }

            return $transactionList;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
