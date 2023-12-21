<?php

require_once __DIR__ . '/../Services/InventarisirService.php';
require_once __DIR__ . '/../Services/PeminjamanService.php';
require_once __DIR__ . '/../Services/MaintainerService.php';
require_once __DIR__ . '/../Services/FileImageService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Services/ProfileService.php';

class AdminController
{
    private InventarisirService $inventarisirService;
    private PeminjamanService $peminjamanService;
    private MaintainerService $maintainerService;
    private FileImageService $fileImageService;
    private SessionManagerService $sessionManagerService;
    private ProfileService $profileService;

    public function __construct()
    {
        $this->inventarisirService = new InventarisirService();
        $this->peminjamanService = new PeminjamanService();
        $this->maintainerService = new MaintainerService();
        $this->fileImageService = new FileImageService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
        $this->profileService = new ProfileService();

    }
    public function dashboard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $maintainer = $this->inventarisirService->getListMaintainers();
                $status = $this->peminjamanService->getListStatus();
                $statusPeminjaman = $this->peminjamanService->getListStatusPeminjaman();
                $peminjaman = $this->peminjamanService->searchDataPeminjaman('');
                if (empty($peminjaman)) {
                    $peminjaman = [];
                }

                $session = $this->sessionManagerService->get();
                $pengguna = $this->profileService->getProfile($session->id);
                return View::renderView('admin/dashboard/dashboard', compact('peminjaman', 'maintainer', 'status', 'statusPeminjaman', 'pengguna'));
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            View::renderPage('500');
        } catch (Exception $exception) {
            View::renderPage('500');
        }
    }

    public function dataPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $search = input::get('search') ?? '';
                $maintainer = $this->inventarisirService->getListMaintainers();
                $status = $this->peminjamanService->getListStatus();
                $peminjaman = $this->peminjamanService->searchDataPeminjaman($search);
                if (empty($peminjaman)) {
                    $peminjaman = [];
                }
                $session = $this->sessionManagerService->get();
                $pengguna = $this->profileService->getProfile($session->id);
                return View::renderView('admin/data-peminjaman/dataPeminjaman', compact('peminjaman', 'maintainer', 'status', 'pengguna'));
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            View::renderPage('500');
        } catch (Exception $exception) {
            View::renderPage('500');
        }
    }

    public function getDetailDataPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $kode = input::get('kode');
                $result = $this->peminjamanService->DetailDataPeminjaman($kode);
                if (empty($result)) {
                    header('HTTP/1.1 404 Not Found');
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode([
                        'status' => '404',
                        'error' => 'Data not found'
                    ]);
                    exit(404);
                }
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success get data',
                    'data' => $result
                ]);
                exit(200);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function postUpdateDataPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ID_Transaksi = input::post('kode');
                $ID_Maintainer = input::post('maintainer');
                $ID_Status = input::post('status');
                $Pesan = input::post('pesan');
                $kondisi = $_POST['kondisi'];
                $id_detail = $_POST['id_detail'];

                $result = $this->peminjamanService->updatePeminjaman($ID_Transaksi, $ID_Maintainer, $ID_Status, $Pesan, $id_detail, $kondisi);
                if (!$result) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to update data'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 201 Created');
                header('Content-Type: application/json');
                http_response_code(201);
                echo json_encode([
                    'status' => '201',
                    'message' => 'Success update data',
                ]);
                exit(201);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()

            ]);
        }
    }



    public function riwayat()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $search = input::get('search') ?? '';
                $maintainer = $this->inventarisirService->getListMaintainers();
                $status = $this->peminjamanService->getListStatus();
                $peminjaman = $this->peminjamanService->searchRiwayatDataPeminjaman($search);
                if (empty($peminjaman)) {
                    $peminjaman = [];
                }
                $session = $this->sessionManagerService->get();
                $pengguna = $this->profileService->getProfile($session->id);
                return View::renderView('admin/riwayat-peminjaman/riwayat-peminjaman', compact('peminjaman', 'maintainer', 'status', 'pengguna'));
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            View::renderPage('500');
        } catch (Exception $exception) {
            View::renderPage('500');
        }
    }
    public function maintainer()
    {
        try {
            $search = input::get('search') ?? '';
            $maintainers = $this->maintainerService->getMaintainerByNamaLike($search);
            if ($maintainers == null) {
                $maintainers = [];
            }
            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);
            View::renderView('admin/maintainer/maintainer', compact('maintainers', 'search', 'pengguna'));
        } catch (PDOException $exception) {
            View::renderPage('500');
        } catch (Exception $exception) {
            View::renderPage('500');
        }
    }

    public function postCreateMaintainer() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $kode = input::post('kode');
                $nama = input::post('nama');
                $maintainer = new Maintainer();
                $maintainer->ID_Maintainer = $kode;
                $maintainer->Nama_Maintainer = $nama;
                $result = $this->maintainerService->create($maintainer);
                if (!$result) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to save into the database'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 201 Created');
                header('Content-Type: application/json');
                http_response_code(201);
                echo json_encode([
                    'status' => '201',
                    'message' => 'Success create data',
                ]);
                exit(201);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

    public function getMaintainer()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $kode = input::get('kode');
                $maintainer = $this->maintainerService->getMaintainerById($kode);
                if ($maintainer == null) {
                    header('HTTP/1.1 404 Not Found');
                    header('Content-Type: application/json');
                    http_response_code(404);
                    echo json_encode([
                        'status' => '404',
                        'error' => 'Maintainer not found'
                    ]);
                    exit(404);
                }
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success get data',
                    'data' => $maintainer
                ]);
                exit(200);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

    public function putUpdateMaintainer() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                $input_data = file_get_contents("php://input");
                $data = json_decode($input_data, true);
                $maintainer = new Maintainer();
                $maintainer->ID_Maintainer = $data['kode'];
                $maintainer->Nama_Maintainer = $data['nama'];
                $result = $this->maintainerService->update($maintainer);

                if (!$result) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to update data'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success update data',
                ]);
                exit(200);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

    public function deleteMaintainer() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $kode = input::get('kode');
                $result = $this->maintainerService->delete($kode);
                if (!$result) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to delete data'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success delete data',
                ]);
                exit(200);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }

    }

    public function inventarisir()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === "GET") {
                $search = input::get('search') ?? '';
                $maintainer = $this->inventarisirService->getListMaintainers();
                $kategori = $this->inventarisirService->getListKategori();
                $asal = $this->inventarisirService->getListAsal();
                $inventarisir = $this->inventarisirService->search($search);
                if (empty($inventarisir)) {
                    $inventarisir = [];
                }
                $session = $this->sessionManagerService->get();
                $pengguna = $this->profileService->getProfile($session->id);
                return View::renderView('admin/inventarisir/inventarisir', compact('inventarisir', 'maintainer', 'kategori', 'asal', 'pengguna'));
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            View::renderPage('500');
        } catch (Exception $exception) {
            View::renderPage('500');
        }
    }
    public function postCreateInventariris()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                // If it's not a POST request, return an error
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }

            if (empty($_FILES['gambar']['name'])) {
                header('HTTP/1.1 400 Bad Request');
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'status' => '400',
                    'error' => 'Gambar is required'
                ]);
                exit(400);
            }

            $image = $_FILES['gambar'];
            $imageName = $this->fileImageService->randomImageName($image);

            if ($this->fileImageService->upload('inventarisir', $imageName, $image)) {
                // File uploaded successfully

                $inventarisir = new Inventaris();
                $inventarisir->Nama_Inventaris = input::post('namaBarang');
                $inventarisir->ID_Kategori = input::post('kategori');
                $inventarisir->Asal = input::post('asal');
                $inventarisir->Stok = input::post('jumlahBarang');
                $inventarisir->Deskripsi = input::post('keterangan');
                $inventarisir->Gambar = $imageName;

                // Insert into the database using prepared statements
                $inventaris = $this->inventarisirService->createInventarisir($inventarisir);

                if (!$inventaris) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to save into the database'
                    ]);
                    unlink($this->fileImageService->getPathImage('inventarisir', $imageName)); // Remove the uploaded file
                    exit(500);
                }

                $maintainers = $_POST['maintainers'] ?? [];

                foreach ($maintainers as $value) {
                    $main = new MaintainerInventaris();
                    $main->ID_Maintainer = $value;
                    $main->ID_Inventaris = $inventarisir->ID_Inventaris;
                    $maintainerObjects[] = $main;
                }

                // Insert maintainers into the database
                $maintainerInventaris = $this->inventarisirService->create($maintainerObjects);

                if (!$maintainerInventaris) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to save into the database'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 201 Created');
                header('Content-Type: application/json');
                http_response_code(201);
                echo json_encode([
                    'status' => '201',
                    'message' => 'Success create data',
                ]);
                exit(201);
            } else {
                // Failed to move uploaded file
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode([
                    'status' => '500',
                    'error' => 'Failed to move uploaded file'
                ]);
                exit(500);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

    public function getInvertarisir()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $kode = input::get('kode');
                $result = $this->inventarisirService->getMaintainerInventarisById($kode);
                if (empty($result))
                {
                    $result = [];

                }
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success get data',
                    'data' => $result
                ]);
            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
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
                $destinationPath = '';
                if (!empty($_FILES['edit-gambar']['name'])) {
                    $image = $_FILES['edit-gambar'];
                    $imageName = $this->fileImageService->randomImageName($image);
                    $destinationPath = $this->fileImageService->getPathImage('inventarisir', $imageName);
                    if ($this->fileImageService->upload('inventarisir', $imageName, $image)) {
                        $inventarisir->Gambar = $imageName;
                    } else {
                        header('HTTP/1.1 500 Internal Server Error');
                        header('Content-Type: application/json');
                        http_response_code(500);
                        echo json_encode([
                            'status' => '500',
                            'error' => 'Failed to move uploaded file'
                        ]);
                        exit(500);
                    }
                } else {
                    $inventarisir->Gambar = $this->inventarisirService->getInventarisById($inventarisir->ID_Inventaris)->Gambar;
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
                if (!$inventaris && !$maintainerInventaris) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to update data'
                    ]);
                    exit(500);
                }

                header('HTTP/1.1 201 Created');
                header('Content-Type: application/json');
                http_response_code(201);
                echo json_encode([
                    'status' => '201',
                    'message' => 'Success update data',
                ]);
                exit(200);

            } else {
                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            // Return an error response for PDO exceptions
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            // Return an error response for other exceptions
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

    public function deleteInventariris() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $kode = input::get('kode');
                $result = $this->inventarisirService->delete($kode);
                if (!$result) {
                    header('HTTP/1.1 500 Internal Server Error');
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode([
                        'status' => '500',
                        'error' => 'Failed to delete data'
                    ]);
                    exit(500);
                }
                header('HTTP/1.1 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode([
                    'status' => '200',
                    'message' => 'Success delete data',
                ]);
                exit(200);
            } else {

                header('HTTP/1.1 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => '405',
                    'error' => 'Method Not Allowed'
                ]);
                exit(405);
            }
        } catch (PDOException $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        } catch (Exception $exception) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => '500',
                'error' => $exception->getMessage()
            ]);
            exit(500);
        }
    }

}
