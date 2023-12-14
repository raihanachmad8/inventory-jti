<?php

require_once __DIR__ . '/../Models/DetailTransaksi.php';

class DetailTransaksiRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = DB::connect();
    }

    public function getListDetailTransaksi() : array
    {
        try {
            $query = "SELECT ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah FROM DetailTransaksi";
            $result = $this->connection->query($query);
            while ($row = $result->fetchObject('DetailTransaksi')) {
                $detail_transaksi[] = $row;
            }
            return $detail_transaksi ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getDetailTransaksiByIdTransaksi(string $ID_Transaksi) : array
    {
        try {
            $query = "SELECT ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah FROM DetailTransaksi WHERE ID_Transaksi = :id_transaksi";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id_transaksi' => $ID_Transaksi
            ]);
            while ($row = $statement->fetchObject('DetailTransaksi')) {
                $detail_transaksi[] = $row;
            }
            return $detail_transaksi ?? [];
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getDetailTransaksiById(string $ID_DetailTrc): DetailTransaksi
    {
        try {
            $query = "SELECT ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah FROM DetailTransaksi WHERE ID_DetailTrc = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_DetailTrc
            ]);
            $detail_transaksi = $statement->fetchObject('DetailTransaksi');

            return $detail_transaksi ?? throw new Exception('Detail Transaksi not found');
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function create(DetailTransaksi $detailTransaksi) : bool
    {
        try {
            $this->connection->beginTransaction();
            $query = "INSERT INTO detail_transaksi
            (ID_DetailTrc, ID_Transaksi, ID_Inventaris, Jumlah) VALUES
            (:id, :id_transaksi, :id_inventaris, :jumlah)";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $detailTransaksi->ID_DetailTrc,
                'id_transaksi' => $detailTransaksi->ID_Transaksi,
                'id_inventaris' => $detailTransaksi->ID_Inventaris,
                'jumlah' => $detailTransaksi->Jumlah
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

    public function delete(string $ID_DetailTrc) : bool
    {
        try {
            $query = "DELETE FROM DetailTransaksi WHERE ID_DetailTrc = :id";
            $statement = $this->connection->prepare($query);
            $statement->execute([
                'id' => $ID_DetailTrc
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

}
