<?php

require_once __DIR__ . '/../Services/InventarisirService.php';

class AdminController
{
    private InventarisirService $inventarisirService;
    public function __construct()
    {
        $this->inventarisirService = new InventarisirService();
    }
    public function dashboard()
    {
        return View::renderView('admin/dashboard/dashboard');
    }

    public function dataPeminjaman()
    {
        return View::renderView('admin/data-peminjaman/dataPeminjaman');
    }

    public function inventarisir()
    {
        $search = input::get('search') ?? '';
        $maintainer = $this->inventarisirService->getListMaintainers();
        $kategori = $this->inventarisirService->getListKategori();
        $asal = $this->inventarisirService->getListAsal();
        $inventarisir = $this->inventarisirService->search($search);
        return View::renderView('admin/inventarisir/inventarisir', compact('inventarisir', 'maintainer', 'kategori', 'asal'));
    }

    public function riwayat()
    {
        return View::renderView('admin/riwayat-peminjaman/riwayat-peminjaman');
    }
    public function maintainer()
    {
        return View::renderView('admin/maintainer/maintainer');
    }
    public function maintainerdetails()
    {
        return View::renderView('admin/maintainer/details');
    }

    public function postCreateInventariris()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $uploadedFile = $_FILES['gambar'];
                $originalExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
                $newFilename = $this->generateRandomName() . '-' . $this->generateRandomName(6) . '.' . $originalExtension;

                $storageDirectory = __DIR__ . "/../../public/assets/images/inventarisir/";
                $destinationPath = $storageDirectory . $newFilename;

                if (move_uploaded_file($uploadedFile['tmp_name'], $destinationPath)) {
                    // File uploaded successfully
                    $inventarisir = new Inventaris();
                    $inventarisir->ID_Inventaris = $this->generateRandomName();
                    $inventarisir->Nama_Inventaris = input::post('namaBarang');
                    $inventarisir->ID_Kategori = input::post('kategori');
                    $inventarisir->Asal = input::post('asal');
                    $inventarisir->Stok = input::post('jumlahBarang');
                    $inventarisir->Deskripsi = input::post('keterangan');
                    $inventarisir->Gambar = $newFilename;
                    $inventaris = $this->inventarisirService->createInventarisir($inventarisir);
                    if (!$inventaris) {
                        http_response_code(500);
                        echo 'Failed to save into the database';
                        exit(500);
                    }
                    $maintainers[] = $_POST['maintainers'];
                    foreach ($maintainers as $item) {
                        foreach ($item as $value) {
                            $main = new MaintainerInventaris();
                            var_dump($value);
                            $main->ID_Maintainer = $value;
                            $main->ID_Inventaris = $inventarisir->ID_Inventaris;
                            $maintainerObjects[] = $main;
                        }
                    }
                    $maintainerInventaris = $this->inventarisirService->create($maintainerObjects);
                    if (!$maintainerInventaris) {
                        http_response_code(500);
                        echo 'Failed to save into the database';
                        exit(500);
                    }
                    http_response_code(201);
                    echo 'Success';
                } else {
                    // Failed to move uploaded file
                    unlink($destinationPath);
                }
            } else {
                // method not allowed
                http_response_code(405);
                echo 'Method not allowed';
                exit(405);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        }
    }

    public function getInvertarisir()
    {
        try {

            $kode = input::get('kode');

            if ($kode !== null) {
                $maintainerInventaris = $this->inventarisirService->getMaintainerInventarisById($kode);

                if ($maintainerInventaris == null) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Maintainer Inventaris not found']);
                    exit(404);
                }
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(['data' => $maintainerInventaris]);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        }
    }

    public function putUpdateInventariris()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $inventarisir = new Inventaris();
                $inventarisir->ID_Inventaris = input::post('edit-kode');
                $inventarisir->Nama_Inventaris = input::post('edit-namaBarang');
                $inventarisir->ID_Kategori = input::post('edit-kategori');
                $inventarisir->Asal = input::post('edit-asal');
                $inventarisir->Stok = input::post('edit-jumlahBarang');
                $inventarisir->Deskripsi = input::post('edit-keterangan');

                if (!empty($_FILES['edit-gambar']['name'])) {
                    $uploadedFile = $_FILES['edit-gambar'];
                    $originalExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
                    $newFilename = $this->generateRandomName() . '-' . $this->generateRandomName(6) . '.' . $originalExtension;

                    $storageDirectory = __DIR__ . "/../../public/assets/images/inventarisir/";
                    $destinationPath = $storageDirectory . $newFilename;

                    if (move_uploaded_file($uploadedFile['tmp_name'], $destinationPath)) {
                        // File uploaded successfully
                        $inventarisir->Gambar = $newFilename;
                    } else {
                        // Failed to move uploaded file
                        http_response_code(500);
                        echo 'Failed to move uploaded file';
                        exit(500);
                    }
                } else {
                    $inventarisir->Gambar = input::post('edit-gambar-lama');
                }

                $inventaris = $this->inventarisirService->updateInvertarisir($inventarisir);
                $maintainers[] = $_POST['maintainers'];
                foreach ($maintainers as $item) {
                    foreach ($item as $value) {
                        $main = new MaintainerInventaris();
                        $main->ID_Maintainer = $value;
                        $main->ID_Inventaris = $inventarisir->ID_Inventaris;
                        $maintainerObjects[] = $main;
                    }
                }
                $maintainerInventaris = $this->inventarisirService->update($maintainerObjects);
                if (!$inventaris || !$maintainerInventaris) {
                    http_response_code(500);
                    if ($_FILES['edit-gambar']['name'] !== null) {
                        unlink($destinationPath);
                    }
                    echo 'Failed to save into the database';
                    exit(500);
                }
                http_response_code(200);
                echo 'Success';

            } else {
                // method not allowed
                http_response_code(405);
                echo 'Method not allowed';
                exit(405);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        }
    }

    public function deleteInventariris() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $kode = input::get('kode');
                $result = $this->inventarisirService->delete($kode);
                if (!$result) {
                    // If the delete operation fails, return an error response
                    http_response_code(500);
                    echo 'Failed to delete data';
                    exit(500);
                }
                http_response_code(200);
                echo 'Success';
            } else {
                // If it's not a DELETE request, return an error
                header('HTTP/1.1 405 Method Not Allowed');
                http_response_code(405);
                echo 'Method Not Allowed';
                exit(405);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            http_response_code(500);
            echo $exception->getMessage();
            exit(500);
        }
    }

    public function generateRandomName($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}
