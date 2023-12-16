<?php

require_once __DIR__ . '/../Repository/TransaksiRepository.php';
require_once __DIR__ . '/../Repository/DetailTransaksiRepository.php';
require_once __DIR__ . '/../Repository/InventarisRepository.php';
require_once __DIR__ . '/../Repository/KategoriRepository.php';
require_once __DIR__ . '/../Repository/MaintainerInventarisRepository.php';
require_once __DIR__ . '/../Repository/MaintainerRepository.php';
require_once __DIR__ . '/../Repository/PenggunaRepository.php';
require_once __DIR__ . '/../Repository/StatusRepository.php';
require_once __DIR__ . '/../Repository/LevelRepository.php';

class PeminjamanService
{
    private TransaksiRepository $transaksiRepository;
    private DetailTransaksiRepository $detailTransaksiRepository;
    private InventarisRepository $inventarisRepository;
    private KategoriRepository $kategoriRepository;
    private MaintainerRepository $maintainerRepository;
    private PenggunaRepository $penggunaRepository;
    private StatusRepository $statusRepository;
    private LevelRepository $levelRepository;

    public function __construct()
    {
        $this->transaksiRepository = new TransaksiRepository();
        $this->detailTransaksiRepository = new DetailTransaksiRepository();
        $this->inventarisRepository = new InventarisRepository();
        $this->kategoriRepository = new KategoriRepository();
        $this->maintainerRepository = new MaintainerRepository();
        $this->penggunaRepository = new PenggunaRepository();
        $this->statusRepository = new StatusRepository();
        $this->levelRepository = new LevelRepository();
    }

    public function searchDataPeminjaman(string $keyword = '' ) : array
    {
        $result = $this->transaksiRepository->searchListTransaksiByStatus(['Menunggu', 'Diterima', 'Proses', 'Menunggu Ganti'], $keyword);
        $result = array_map(function($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin);
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }
    public function searchRiwayatDataPeminjaman(string $keyword = '' ) : array
    {
        $result = $this->transaksiRepository->searchListRiwayatTransaksiByStatus(['Menunggu', 'Ditolak', 'Diterima', 'Proses', 'Selesai', 'Dibatalkan', 'Menunggu Ganti'], $keyword);
        $result = array_map(function($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin);
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }

    public function DetailDataPeminjaman(string $ID_transaksi) : Transaksi
    {
        try {
            $result = $this->transaksiRepository->getTransaksiById($ID_transaksi);
            $result->Pengguna = $this->penggunaRepository->getPenggunaById($result->ID_Pengguna);
            $result->Status = $this->statusRepository->getStatusById($result->ID_Status);
            $result->Admin = $this->maintainerRepository->getMaintainerById($result->ID_Admin);
            $result->Pengguna->Level = $this->levelRepository->getLevelById($result->Pengguna->ID_Level);
            $result->DetailTransaksi = $this->detailTransaksiRepository->getDetailTransaksiByIdTransaksi($result->ID_Transaksi);
            $result->DetailTransaksi = array_map(function($item) {
                $item->Inventaris = $this->inventarisRepository->getInventarisById($item->ID_Inventaris);
                $item->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($item->Inventaris->ID_Kategori);
                return $item;
            }, $result->DetailTransaksi);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function updatePeminjaman(string $ID_transaksi, string $ID_Admin, string $ID_Status, $Pesan, array $ID_DetailTrc, array $kondisi) : bool
    {
        try {
            $result = $this->transaksiRepository->updateDataPeminjaman($ID_transaksi, $ID_Admin, $ID_Status, $Pesan);
            $result2 = $this->detailTransaksiRepository->updateDetailTrc($ID_DetailTrc, $kondisi);
            return $result && $result2;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListMaintainer() : array
    {
        try {
            $result = $this->maintainerRepository->getListMaintainers();
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getListStatus() : array
    {
        try {
            $result = $this->statusRepository->getListStatus();
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getListStatusPeminjaman() : array
    {
        try {
            $result = $this->transaksiRepository->countStatusTransaksi(['Menunggu', 'Diterima', 'Selesai', 'Proses']);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}
