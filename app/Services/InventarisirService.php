<?php

use function PHPSTORM_META\map;

require_once __DIR__ . '/../Repository/InventarisRepository.php';
require_once __DIR__ . '/../Repository/KategoriRepository.php';
require_once __DIR__ . '/../Repository/MaintainerInventarisRepository.php';
require_once __DIR__ . '/../Repository/MaintainerRepository.php';

class InventarisirService
{
    private InventarisRepository $inventarisRepository;
    private KategoriRepository $kategoriRepository;
    private MaintainerRepository $maintainerRepository;
    private MaintainerInventarisRepository $maintainerInventarisRepository;

    public function __construct()
    {
        $this->inventarisRepository = new InventarisRepository();
        $this->kategoriRepository = new KategoriRepository();
        $this->maintainerRepository = new MaintainerRepository();
        $this->maintainerInventarisRepository = new MaintainerInventarisRepository();
    }

    public function getListKategori() : array
    {
        return $this->kategoriRepository->getListKategori();
    }
    public function getListMaintainers() : array
    {
        return $this->maintainerRepository->getListMaintainers();
    }

    public function getListAsal() : array
    {
        return [
            'BELI' => 'BELI',
            'HIBAH' => 'HIBAH'
        ];
    }

    public function getInventarisById(string $id) : Inventaris
    {
        return $this->inventarisRepository->getInventarisById($id);
    }
    public function getListInventaris() : array
    {
        $result = $this->maintainerInventarisRepository->getListMaintainerInventaris();
        $result = array_map(function($item) {
            $item->MaintainerList = $this->maintainerRepository->getListMaintainerByID($item->ID_Inventaris);
            $item->Inventaris = $this->inventarisRepository->getInventarisById($item->ID_Inventaris);
            $item->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($item->Inventaris->ID_Kategori);

            return $item;  // Return the modified item
        }, $result);
        return $result;
    }

    public function getMaintainerInventarisById(string $id_inventaris) : MaintainerInventaris
    {
        $result = $this->maintainerInventarisRepository->get($id_inventaris);
        $result->MaintainerList = $this->maintainerRepository->getListMaintainerByID($result->ID_Inventaris);
        $result->Inventaris = $this->inventarisRepository->getInventarisById($result->ID_Inventaris);
        $result->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($result->Inventaris->ID_Kategori);

        return $result;
    }

    public function create(array $maintainerInventarisir) : bool
    {
        try {
            foreach ($maintainerInventarisir as $mainInvent) {
                $maintainerInventaris = $this->maintainerInventarisRepository->create($mainInvent);
                if (!$maintainerInventaris) {
                    throw new Exception('Failed to create Maintainer Inventaris');
                }
            }

            return $maintainerInventaris;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function update(array $maintainerInventaris) : bool
    {
        try {

            $maintainerInventaris = $this->maintainerInventarisRepository->update($maintainerInventaris[0]->ID_Inventaris, $maintainerInventaris);
            return $maintainerInventaris ?? false;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function delete($id) : bool
    {
        try {
            $maintainerInventaris = $this->maintainerInventarisRepository->delete($id);
            $inventaris = $this->inventarisRepository->delete($id);
            return $maintainerInventaris && $inventaris;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function search(string $keyword = '') : array
    {
        try {
            $result = $this->maintainerInventarisRepository->search($keyword);
            $result = array_map(function($item) {
                $item->MaintainerList = $this->maintainerRepository->getListMaintainerByID($item->ID_Inventaris);
                $item->Inventaris = $this->inventarisRepository->getInventarisById($item->ID_Inventaris);
                $item->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($item->Inventaris->ID_Kategori);

                return $item;  // Return the modified item
            }, $result);
            return $result;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function createInventarisir(Inventaris $inventaris) : bool
    {
        try {
            $lastID = $this->inventarisRepository->getLastId();
            $numbers = preg_replace('/[^0-9]/', '', $lastID);
            $lastID = 'I' . $numbers + 1;
            $inventaris->ID_Inventaris = $lastID;
            $inventaris = $this->inventarisRepository->create($inventaris);
            return $inventaris;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function updateInvertarisir(Inventaris $inventaris) : bool
    {
        try {
            $inventaris = $this->inventarisRepository->update($inventaris);
            return $inventaris;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
