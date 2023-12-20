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
    private MaintainerInventarisRepository $maintainerInventoryRepository;

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
        $this->maintainerInventoryRepository = new MaintainerInventarisRepository();
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
    public function searchRiwayatDataPeminjamanPengguna(string $ID_Pengguna, string $keyword = '' ) : array
    {
        $result = $this->transaksiRepository->searchListRiwayatTransaksiByStatus(['Menunggu', 'Ditolak', 'Diterima', 'Proses', 'Selesai', 'Dibatalkan', 'Menunggu Ganti'], $keyword, $ID_Pengguna);
        $result = array_map(function($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin);
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }
    public function searchRiwayatDataPeminjaman(string $keyword = '') : array
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
    public function getListStatusPeminjamanPengguna(string $ID_Pengguna) : array
    {
        try {
            $result = $this->transaksiRepository->countStatusTransaksi(['Menunggu', 'Diterima', 'Selesai', 'Proses'], $ID_Pengguna);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function searchPeminjamanByPengguna(string $ID_Pengguna) {
        try {
            $result = $this->transaksiRepository->searchListTransaksiByStatus(['Menunggu', 'Diterima', 'Proses', 'Menunggu Ganti'], '', $ID_Pengguna);
            $result = array_map(function($item) {
                $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
                $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
                $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin);
                $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
                return $item;
            }, $result);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function availableStok() {
        try {
            $available = $this->transaksiRepository->avaibleStok();
            $inventory = $this->inventarisRepository->getListInventaris();
            $inventory = array_map(function($item) {
                $item->Kategori = $this->kategoriRepository->getKategoriById($item->ID_Kategori);
                return $item;
            }, $inventory);

            $filteredInventory = array_filter($inventory, function ($item) use ($available) {
                $totalBorrowed = array_reduce($available, function ($carry, $availableItem) use ($item) {
                    if ($item->ID_Inventaris == $availableItem['ID_Inventaris']) {
                        return $carry + $availableItem['TotalBorrowed'];
                    }
                    return $carry;
                }, 0);

                return ($item->Stok - $totalBorrowed) > 0;
            });

            // Sorting by AvailableStock in descending order
            usort($filteredInventory, function($a, $b) {
                return $b->Stok - $this->getTotalBorrowed($b) - ($a->Stok - $this->getTotalBorrowed($a));
            });
            $result = array_map(function($item) {
                return [
                    'ID_Inventaris' => $item->ID_Inventaris,
                    'Nama_Inventaris' => $item->Nama_Inventaris,
                    'Stok' => $item->Stok,
                    'Kategori' => $item->Kategori,
                    'Gambar' => $item->Gambar,
                    'AvailableStock' => $item->Stok - $this->getTotalBorrowed($item)
                ];
            }, $filteredInventory);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    private function getTotalBorrowed($item) {
        $available = $this->transaksiRepository->avaibleStok();
        return array_reduce($available, function ($carry, $availableItem) use ($item) {
            if ($item->ID_Inventaris == $availableItem['ID_Inventaris']) {
                return $carry + $availableItem['TotalBorrowed'];
            }
            return $carry;
        }, 0);
    }

    public function getListPeminjamanWithAvailableStockAndSearch(string $search): array
    {
        $available = $this->transaksiRepository->avaibleStok();
        $inventory = $this->maintainerInventoryRepository->search($search);

        $inventory = array_map(function($item) {
                $item->Inventaris = $this->inventarisRepository->getInventarisById($item->ID_Inventaris);
                $item->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($item->Inventaris->ID_Kategori);
                $item->Maintainer = $this->maintainerRepository->getMaintainerById($item->ID_Maintainer);
                return $item;
            }, $inventory);
            $filteredInventory = array_filter($inventory, function ($item) use ($available) {
                $totalBorrowed = array_reduce($available, function ($carry, $availableItem) use ($item) {
                    if ($item->ID_Inventaris == $availableItem['ID_Inventaris']) {
                        return $carry + $availableItem['TotalBorrowed'];
                    }
                    return $carry;
                }, 0);

                return ($item->Inventaris->Stok - $totalBorrowed) > 0;
            });

            // Sorting by AvailableStock in descending order
            usort($filteredInventory, function($a, $b) {
                return $b->Inventaris->Stok - $this->getTotalBorrowed($b) - ($a->Inventaris->Stok - $this->getTotalBorrowed($a));
            });

            $result = array_map(function ($item) {
                return [
                    'ID_Inventaris' => $item->Inventaris->ID_Inventaris,
                    'Nama_Inventaris' => $item->Inventaris->Nama_Inventaris,
                    'Stok' => $item->Inventaris->Stok,
                    'Gambar' => $item->Inventaris->Gambar,
                    'Kategori' => $item->Inventaris->Kategori,
                    'AvailableStock' => $item->Inventaris->Stok - $this->getTotalBorrowed($item),
                    'MaintainerName' => $item->Maintainer->Nama_Maintainer, // Adjust this according to your Maintainer structure
                ];
            }, $filteredInventory);

            $uniqueItems = [];
            foreach ($result as $item) {
                $key = $item['ID_Inventaris'] . $item['Nama_Inventaris'] . $item['Kategori']->ID_Kategori;

                // Check if the combination already exists in the uniqueItems array
                if (!isset($uniqueItems[$key])) {
                    $uniqueItems[$key] = [
                        'ID_Inventaris' => $item['ID_Inventaris'],
                        'Nama_Inventaris' => $item['Nama_Inventaris'],
                        'Kategori' => $item['Kategori'],
                        'Gambar' => $item['Gambar'],
                        'Stok' => $item['Stok'],
                        'AvailableStock' => $item['AvailableStock'],
                        'MaintainerNames' => [$item['MaintainerName']], // Initialize array with the first maintainer
                        // Add other fields as needed
                    ];
                } else {
                    // If the combination already exists, add the maintainer to the existing array only if it doesn't already exist
                    if (!in_array($item['MaintainerName'], $uniqueItems[$key]['MaintainerNames'])) {
                        $uniqueItems[$key]['MaintainerNames'][] = $item['MaintainerName'];
                    }
                }
        }

        return array_values($uniqueItems);
    }

    public function deleteHistoryPeminjaman(string $ID_transaksi)
    {
        try {
            $result = $this->transaksiRepository->getTransaksiById($ID_transaksi);
            if ($result->ID_Status !== 'S1' ) {
                throw new Exception('Peminjaman tidak dapat dibatalkan');
            }
            $batasWaktuPembatalan = strtotime($result->StartDate . ' +1 day');
            if (time() > $batasWaktuPembatalan) {
                throw new Exception('Peminjaman tidak dapat dibatalkan karena sudah melewati batas waktu pembatalan');
            }

            $result = $this->transaksiRepository->batalkanPeminjaman($ID_transaksi);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}
