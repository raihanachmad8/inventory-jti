<?php

require_once __DIR__ . '/../Repository/MaintanerInventarisRepository.php';
require_once __DIR__ . '/../Repository/InventarisRepository.php';
require_once __DIR__ . '/../Repository/MaintainerRepository.php';
require_once __DIR__ . '/../Repository/KategoriRepository.php';
class InventarisirService
{
    private MaintainerInventarisRepository $maintainerInventarisRepository;
    private InventarisRepository $inventarisRepository;
    private KategoriRepository $kategoriRepository;
    private MaintainerRepository $maintainerRepository;

    public function __construct()
    {
        $this->maintainerInventarisRepository = new MaintainerInventarisRepository(DB::connect());
        $this->inventarisRepository = new InventarisRepository(DB::connect());
        $this->kategoriRepository = new KategoriRepository(DB::connect());
        $this->maintainerRepository = new MaintainerRepository(DB::connect());
    }

    public function getAll(): array
    {
        try {
        return $this->maintainerInventarisRepository->getAll();
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }

    public function get(string $ID_Maintainer = null, $ID_Inventaris = null): MaintainerInventaris
    {
        try {
        return $this->maintainerInventarisRepository->get($ID_Maintainer, $ID_Inventaris);
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }

    public function getListMaintainer() : array
    {
        try {
            return $this->maintainerInventarisRepository->getListMaintainer();
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }

    }

    public function getListAsal()
    {
        try {
            return [
                Inventaris::ASAL_BELI,
                Inventaris::ASAL_HIBAH
            ];
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }

    public function getListKategori()
    {
        try {
            return $this->kategoriRepository->getAll();
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }

    public function getMaintainer(
        ?string $ID_Maintainer = null,
        ?string $Nama = null,
    ) : ?Maintainer{
        try {
            return $this->maintainerRepository->get($ID_Maintainer, $Nama);
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }

    public function getCategory(
        ?string $ID_Kategori = null,
        ?string $Nama = null,
    ) : ?Kategori{
        try {
            return $this->kategoriRepository->get($ID_Kategori, $Nama);
        } catch (PDOException $e) {
            throw new Exception('Terjadi kesalahan saat mengambil data inventarisir');
        }
    }



    public function create(array $request): bool
    {
        try {

            $inventaris = new Inventaris($request);
            $this->inventarisRepository->insert($inventaris);
            $this->maintainerInventarisRepository->insert($inventaris->getID(), $request['ID_Maintainer']);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(array $request): bool
    {
        try {
            $inventaris = new Inventaris($request);
            $this->inventarisRepository->update($inventaris);
            $this->maintainerInventarisRepository->update($inventaris->getID(), $request['ID_Maintainer']);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(string $ID_Inventaris) : bool {
        try {
            $this->maintainerInventarisRepository->delete(null, $ID_Inventaris);
            $this->inventarisRepository->delete($ID_Inventaris);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
