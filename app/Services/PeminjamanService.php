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

    public function searchDataPeminjaman(string $keyword = ''): array
    {
        $result = $this->transaksiRepository->searchListTransaksiByStatus(['Menunggu', 'Diterima', 'Proses', 'Menunggu Ganti'], $keyword);
        $result = array_map(function ($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            (!empty($item->ID_Admin)) ? $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin) : null;
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }
    public function searchRiwayatDataPeminjamanPengguna(string $ID_Pengguna, string $keyword = ''): array
    {
        $result = $this->transaksiRepository->searchListRiwayatTransaksiByStatus(['Menunggu', 'Ditolak', 'Diterima', 'Proses', 'Selesai', 'Dibatalkan', 'Menunggu Ganti'], $keyword, $ID_Pengguna);
        $result = array_map(function ($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            (!empty($item->ID_Admin)) ? $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin) : null;
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }
    public function searchRiwayatDataPeminjaman(string $keyword = ''): array
    {
        $result = $this->transaksiRepository->searchListRiwayatTransaksiByStatus(['Menunggu', 'Ditolak', 'Diterima', 'Proses', 'Selesai', 'Dibatalkan', 'Menunggu Ganti'], $keyword);
        $result = array_map(function ($item) {
            $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
            $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
            (!empty($item->ID_Admin)) ? $item->Admin = $this->maintainerRepository->getMaintainerById($item->ID_Admin) : null;
            $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
            return $item;
        }, $result);
        return $result;
    }

    public function DetailDataPeminjaman(string $ID_transaksi): Transaksi
    {
        try {
            $result = $this->transaksiRepository->getTransaksiById($ID_transaksi);
            $result->Pengguna = $this->penggunaRepository->getPenggunaById($result->ID_Pengguna);
            $result->Status = $this->statusRepository->getStatusById($result->ID_Status);
            (!empty($result->ID_Admin)) ? $result->Admin = $this->maintainerRepository->getMaintainerById($result->ID_Admin) : null;
            $result->Pengguna->Level = $this->levelRepository->getLevelById($result->Pengguna->ID_Level);
            $result->DetailTransaksi = $this->detailTransaksiRepository->getDetailTransaksiByIdTransaksi($result->ID_Transaksi);
            $result->DetailTransaksi = array_map(function ($item) {
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

    public function updatePeminjaman(string $ID_transaksi, string $ID_Admin, string $ID_Status, $Pesan, array $ID_DetailTrc, array $kondisi): bool
    {
        try {
            $message = $Pesan;
            // $lastSeparatorPosition = strrpos($message, "||");
            // $firstPart = trim(substr($message, 0, $lastSeparatorPosition));
            $Pesan = $message;
            $Pesan = $Pesan . " || " . (new DateTime('now'))->format('Y-m-d H:i:s');
            $result = $this->transaksiRepository->updateDataPeminjaman($ID_transaksi, $ID_Admin, $ID_Status, $Pesan);
            $result2 = $this->detailTransaksiRepository->updateDetailTrc($ID_DetailTrc, $kondisi);
            return $result && $result2;
        } catch (PDOException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getListMaintainer(): array
    {
        try {
            $result = $this->maintainerRepository->getListMaintainers();
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getListStatus(): array
    {
        try {
            $result = $this->statusRepository->getListStatus();
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getListStatusPeminjaman(): array
    {
        try {
            $result = $this->transaksiRepository->countStatusTransaksi(['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7']);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
    public function getListStatusPeminjamanPengguna(string $ID_Pengguna): array
    {
        try {
            $result = $this->transaksiRepository->countStatusTransaksi(['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7'], $ID_Pengguna);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function searchPeminjamanByPengguna(string $ID_Pengguna)
    {
        try {
            $result = $this->transaksiRepository->searchListTransaksiByStatus(['Menunggu', 'Diterima', 'Proses', 'Menunggu Ganti'], '', $ID_Pengguna);
            $result = array_map(function ($item) {
                $item->Pengguna = $this->penggunaRepository->getPenggunaById($item->ID_Pengguna);
                $item->Status = $this->statusRepository->getStatusById($item->ID_Status);
                (!empty($item->ID_Admin)) ? $item->Admin =  $this->maintainerRepository->getMaintainerById($item->ID_Admin) : null;
                $item->Pengguna->Level = $this->levelRepository->getLevelById($item->Pengguna->ID_Level);
                return $item;
            }, $result);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function availableStok()
    {
        try {
            $available = $this->transaksiRepository->avaibleStok();
            $inventory = $this->inventarisRepository->getListInventaris();
            $inventory = array_map(function ($item) {
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
            usort($filteredInventory, function ($a, $b) {
                return $b->Stok - $this->getTotalBorrowed($b) - ($a->Stok - $this->getTotalBorrowed($a));
            });
            $result = array_map(function ($item) {
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

    private function getTotalBorrowed($item)
    {
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

        $inventory = array_map(function ($item) {
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
        usort($filteredInventory, function ($a, $b) {
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
            if ($result->ID_Status !== 'S1') {
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

    public function createPeminjaman(array $request)
    {
        try {

            if ($this->checkAvailableStock($request['items'])) {
                $DetailTransaksi = array_map(function ($item) {
                    return [
                        'ID_Inventaris' => $item->ID_Inventaris,
                        'Jumlah' => $item->Jumlah,
                        'Kondisi' => 'Baik',
                        'Keterangan' => ''
                    ];
                }, $request['items']);
            } else {
                throw new Exception('Requested quantity exceeds available stock');
            }

            $transaksi = new Transaksi();
            $lastID = $this->transaksiRepository->getLastId();
            $numbers = preg_replace('/[^0-9]/', '', $lastID);
            $lastID = 'T' . $numbers + 1;
            $transaksi->ID_Transaksi = $lastID;
            $transaksi->ID_Pengguna = $request['ID_Pengguna'];
            $transaksi->ID_Admin = null;
            $transaksi->ID_Status = 'S1';
            $transaksi->StartDate = $request['StartDate'];
            $transaksi->EndDate = $request['EndDate'];
            $transaksi->Deskripsi_Keperluan = $request['Deskripsi_Keperluan'];
            $transaksi->Jaminan = $request['Jaminan'];
            $transaksi->Pesan = '';

            $transaksi->Pesan = $transaksi->Pesan . " || " . (new DateTime('now'))->format('Y-m-d H:i:s');

            $transaksiResult = $this->transaksiRepository->create($transaksi);
            $DetailTransaksiResult = array_map(function ($item) use ($transaksi) {
                $lastID = $this->detailTransaksiRepository->getLastId();
                $numbers = preg_replace('/[^0-9]/', '', $lastID);
                $lastID = 'DT' . $numbers + 1;

                $detailTransaksi = new DetailTransaksi();
                $detailTransaksi->ID_DetailTrc = $lastID;
                $detailTransaksi->ID_Transaksi = $transaksi->ID_Transaksi;
                $detailTransaksi->ID_Inventaris = $item['ID_Inventaris'];
                $detailTransaksi->Kondisi = 'Normal';
                $detailTransaksi->Jumlah = $item['Jumlah'];
                return $this->detailTransaksiRepository->create($detailTransaksi);
            }, $DetailTransaksi);

            return $transaksiResult && $DetailTransaksiResult;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function checkAvailableStock(array $items): bool
    {
        try {
            $available = $this->transaksiRepository->avaibleStok();
            $inventory = $this->inventarisRepository->getListInventaris();
            $inventory = array_map(function ($item) {
                $item->Kategori = $this->kategoriRepository->getKategoriById($item->ID_Kategori);
                return $item;
            }, $inventory);

            foreach ($items as $request) {
                // Find the item in the inventory
                $item = array_values(array_filter($inventory, function ($inventoryItem) use ($request) {

                    return $inventoryItem->ID_Inventaris == $request->ID_Inventaris;
                }));

                // If the item is found, check if the requested quantity exceeds the available stock
                if (!empty($item)) {
                    $item = $item[0];
                    $totalBorrowed = array_reduce($available, function ($carry, $availableItem) use ($item) {
                        if ($item == $availableItem['ID_Inventaris']) {
                            return $carry + $availableItem['TotalBorrowed'];
                        }
                        return $carry;
                    }, 0);

                    $requestedQuantity = intval($request->Jumlah);
                    if (($item->Stok - $totalBorrowed) < $requestedQuantity) {
                        // Throw an exception if the requested quantity exceeds the available stock
                        throw new Exception('Requested quantity exceeds available stock for item ' . $item);
                    }
                } else {
                    // Throw an exception if the item is not found in the inventory
                    throw new Exception('Item ' . $request->ID_Inventaris . ' not found in inventory');
                }
            }

            // If no exception is thrown, it means all requested items are available
            return true;
        } catch (Exception $exception) {
            // Catch and handle the exception
            throw $exception;
        }
    }

    public function getListPesan(string $ID_Pengguna): array
    {
        try {
            $result = $this->transaksiRepository->getListPesan($ID_Pengguna);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function getListDate(string $ID_Pengguna)
    {
        try {
            $result = $this->transaksiRepository->getListDate($ID_Pengguna);
            return $result;
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}
