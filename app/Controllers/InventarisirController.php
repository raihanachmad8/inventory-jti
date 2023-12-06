<?php

require_once __DIR__ . '/../Services/InventarisirService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Services/FileImageService.php';
require_once __DIR__ . '/../Validation/InventarisValidation.php';
require_once __DIR__ . '/../Validation/ImageValidation.php';

class InventarisirController
{
    private InventarisirService $inventarisirService;
    private SessionManagerService $sessionManagerService;
    private FileImageService $fileImageService;

    public function __construct()
    {
        $this->inventarisirService = new InventarisirService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
        $this->fileImageService = new FileImageService();
    }



    public function index()
    {
        $data = $this->inventarisirService->getAll();
        $uniqueCategories = [];
        foreach ($data as $item) {
            $categories[] = $item->inventaris->Kategori->Nama;
            $uniqueCategories = array_merge($uniqueCategories, $categories);
        }
        $uniqueCategories = array_unique($uniqueCategories);

        $uniqueMaintainer = [];
        foreach ($data as $item) {
            $categoriesMaintainer[] = $item->maintainer->Nama;
            $uniqueMaintainer = array_merge($uniqueMaintainer, $categoriesMaintainer);
        }
        $uniqueMaintainer = array_unique($uniqueMaintainer);
        $uniqueAsal = [];
        foreach ($data as $item) {
            $categoriesAsal[] = $item->inventaris->Asal;
            $uniqueAsal = array_merge($uniqueAsal, $categoriesAsal);
        }
        $uniqueAsal = array_unique($uniqueAsal);

        return View::renderView('/admin/inventarisir/inventarisir', [
            'title' => 'Inventarisir',
            'inventarisirList' => $data,
            'kategoriList' => $uniqueCategories,
            'maintainerList' => $uniqueMaintainer,
            'asalList' => $uniqueAsal,
        ]);
    }

    public function show()
    {
        $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : file_get_contents('php://input');
        $data = json_decode($HTTP_RAW_POST_DATA);

        header('Content-Type: application/json');

        if ($data->id !== null) {
            // If $id is valid, fetch the data
            $inventarisirData = $this->inventarisirService->get(null, $data->id);

            echo json_encode([
                'dd' => $data,
                'title' => 'Detail Inventarisir',
                'status' => 'success',
                'message' => 'Berhasil mengambil data inventarisir',
                'inventarisir' => $inventarisirData,
            ]);
        } else {
            // If $id is not provided or invalid, return an error response
            echo json_encode([
                'title' => 'Detail Inventarisir',
                'status' => 'error',
                'message' => 'ID not provided or invalid',
                'inventarisir' => null,
            ]);
        }
    }

    public function createForm()
    {
        $uniqueCategories = [];
        foreach ($this->inventarisirService->getListKategori() as $item) {
            $categories[] = $item->Nama;
            $uniqueCategories = array_merge($uniqueCategories, $categories);
        }
        $uniqueCategories = array_unique($uniqueCategories);

        $uniqueMaintainer = [];
        foreach ($this->inventarisirService->getListMaintainer() as $item) {
            $categoriesMaintainer[] = $item->Nama;
            $uniqueMaintainer = array_merge($uniqueMaintainer, $categoriesMaintainer);
        }
        $uniqueMaintainer = array_unique($uniqueMaintainer);
        $uniqueAsal = [];

        $uniqueAsal = array_unique($this->inventarisirService->getListAsal());

        View::renderView('/admin/inventarisir/form', [
            'title' => 'Tambah Inventarisir',
            'kategoriList' => $uniqueCategories,
            'maintainerList' => $uniqueMaintainer,
            'asalList' => $uniqueAsal,
        ]);
    }

    public function createPost() {
        $katetori = $this->inventarisirService->getCategory(null, input::post('kategori'));
        $maintainer = $this->inventarisirService->getMaintainer(null, input::post('maintainer'));
        $request = [
            'ID_Inventaris' => input::post('kode'),
            'Nama' => input::post('namaBarang'),
            'Stok' => input::post('jmlBarang'),
            'ID_Kategori' => $katetori->getID(),
            'Asal' => input::post('asal'),
            'Deskripsi' => input::post('deskripsi'),
            'ID_Maintainer' => $maintainer->getID(),
        ];
        // $image = $_FILES;
        // var_dump($image);
        try {
            $validate = (new InventarisValidation($request))->validate();
            // $validateImage = (new ImageValidation($_FILES['gambar']))->validate();
            // $merge = array_merge($validate->getErrors(), $validateImage->getErrors());
            if (!empty($validate->getErrors())) {
                throw new Exception('Validasi tidak valid');
            }
            // $dir = __DIR__ . '../../storage/inventarisir/';
            // $upload = $this->fileImageService->upload($_FILES['gambar'], $dir);
            // if ($upload) {
            //     $request['Gambar'] = $upload;
            // }

            $inventarisir = $this->inventarisirService->create($request);
            if (!$inventarisir) {
                throw new Exception('Gagal menambahkan inventarisir');
            }
            View::setFlashData('success', 'Berhasil menambahkan inventarisir');
            header('Location: /admin/inventarisir');
        } catch (ValidationException $e) {
            $errors = $e->getErrors();
            $uniqueCategories = [];
            foreach ($this->inventarisirService->getListKategori() as $item) {
                $categories[] = $item->Nama;
                $uniqueCategories = array_merge($uniqueCategories, $categories);
            }
            $uniqueCategories = array_unique($uniqueCategories);

            $uniqueMaintainer = [];
            foreach ($this->inventarisirService->getListMaintainer() as $item) {
                $categoriesMaintainer[] = $item->Nama;
                $uniqueMaintainer = array_merge($uniqueMaintainer, $categoriesMaintainer);
            }
            $uniqueMaintainer = array_unique($uniqueMaintainer);
            $uniqueAsal = [];


            $uniqueAsal = array_unique($this->inventarisirService->getListAsal());
            echo json_encode([
                'title' => 'Tambah Inventarisir',
                'status' => 'error',
                'message' => 'Gagal menambahkan inventarisir',
                'inventarisir' => null,
            ]);
            $errors = $e->getErrors();
            View::renderView('/admin/inventarisir/form', [
                'title' => 'Tambah Inventarisir',
                'kategoriList' => $uniqueCategories,
                'maintainerList' => $uniqueMaintainer,
                'asalList' => $uniqueAsal,
                'errors' => $errors,
            ]);
            return;
        }
        catch (Exception $e) {
            View::setFlashData('errors', 'Gagal menambahkan inventarisir');
            View::redirect('/admin/inventarisir/form?'. http_build_query([
                'errors' => $e->getMessage()
            ]));
        }

    }

    public function updatePost() {
        $katetori = $this->inventarisirService->getCategory(null, input::post('kategori'));
        $maintainer = $this->inventarisirService->getMaintainer(null, input::post('maintainer'));
        $request = [
            'ID_Inventaris' => input::post('kode'),
            'Nama' => input::post('namaBarang'),
            'Stok' => input::post('jmlBarang'),
            'ID_Kategori' => $katetori->getID(),
            'Asal' => input::post('asal'),
            'Deskripsi' => input::post('deskripsi'),
            'ID_Maintainer' => $maintainer->getID(),
        ];
        // $image = $_FILES;
        var_dump($_FILES);
        try {
            $validate = (new InventarisValidation($request))->validate();
            // $validateImage = (new ImageValidation($_FILES['gambar']))->validate();
            // $merge = array_merge($validate->getErrors(), $validateImage->getErrors());
            if (!empty($validate->getErrors())) {
                throw new Exception('Validasi tidak valid');
            }
            // $dir = __DIR__ . '../../storage/inventarisir/';
            // $upload = $this->fileImageService->upload($_FILES['gambar'], $dir);
            // if ($upload) {
            //     $request['Gambar'] = $upload;
            // }

            $inventarisir = $this->inventarisirService->update($request);
            if (!$inventarisir) {
                throw new Exception('Gagal menambahkan inventarisir');
            }
            View::setFlashData('success', 'Berhasil menambahkan inventarisir');
            header('Location: /admin/inventarisir');
        } catch (ValidationException $e) {
            $errors = $e->getErrors();
            $uniqueCategories = [];
            foreach ($this->inventarisirService->getListKategori() as $item) {
                $categories[] = $item->Nama;
                $uniqueCategories = array_merge($uniqueCategories, $categories);
            }
            $uniqueCategories = array_unique($uniqueCategories);

            $uniqueMaintainer = [];
            foreach ($this->inventarisirService->getListMaintainer() as $item) {
                $categoriesMaintainer[] = $item->Nama;
                $uniqueMaintainer = array_merge($uniqueMaintainer, $categoriesMaintainer);
            }
            $uniqueMaintainer = array_unique($uniqueMaintainer);
            $uniqueAsal = [];


            $uniqueAsal = array_unique($this->inventarisirService->getListAsal());
            echo json_encode([
                'title' => 'Tambah Inventarisir',
                'status' => 'error',
                'message' => 'Gagal menambahkan inventarisir',
                'inventarisir' => null,
            ]);
            $errors = $e->getErrors();
            View::renderView('/admin/inventarisir', [
                'title' => 'Tambah Inventarisir',
                'kategoriList' => $uniqueCategories,
                'maintainerList' => $uniqueMaintainer,
                'asalList' => $uniqueAsal,
                'errors' => $errors,
            ]);
            return;
        }
        catch (Exception $e) {
            View::setFlashData('errors', 'Gagal menambahkan inventarisir');
            View::redirect('/admin/inventarisir?'. http_build_query([
                'errors' => $e->getMessage()
            ]));
        }

    }

    public function delete()
    {
        try {
            $inventarisir = $this->inventarisirService->delete(input::post('kode'));
            if (!$inventarisir) {
                throw new Exception('Gagal menghapus inventarisir');
            }
            View::setFlashData('success', 'Berhasil menghapus inventarisir');
            View::redirect('/admin/inventarisir?' . http_build_query([
                'success' => 'Berhasil menghapus inventarisir'
            ]));
        } catch (Exception $e) {
            View::setFlashData('errors', 'Gagal menghapus inventarisir');
            View::redirect('/admin/inventarisir?' . http_build_query([
                'errors' => $e->getMessage()
            ]));
        }

    }


}
