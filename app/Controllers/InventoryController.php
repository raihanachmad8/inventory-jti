<?php

require_once __DIR__ . '/../Services/PeminjamanService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Services/ProfileService.php';
require_once __DIR__ . '/../Services/FileImageService.php';
require_once __DIR__ . '/../Validation/InventarisValidation.php';

class InventoryController
{
    private PeminjamanService $peminjamanService;
    private SessionManagerService $sessionManagerService;
    private ProfileService $profileService;
    private FileImageService $fileImageService;

    public function __construct()
    {
        $this->peminjamanService = new PeminjamanService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
        $this->profileService = new ProfileService();
        $this->fileImageService = new FileImageService();
    }

    public function dashboard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }

            // $inventory = $this->peminjamanService->searchPeminjamanByPengguna();
            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);
            $peminjaman = $this->peminjamanService->searchPeminjamanByPengguna($pengguna->ID_Pengguna);
            $status = $this->peminjamanService->getListStatusPeminjamanPengguna($pengguna->ID_Pengguna);
            $stok = $this->peminjamanService->availableStok();
            View::renderView('inventory/dashboard/dashboard', compact('peminjaman', 'status', 'stok', 'pengguna'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/dashboard/dashboard', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/dashboard/dashboard', ['error' => $e->getMessage()]);
            }
        }
    }

    public function historyPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }
            $kode = input::get('kode') ?? '';
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
        } catch (Exception $exception) {
            if ($exception instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode([
                    'status' => '500',
                    'error' => $exception->getMessage()
                ]);
                exit(500);
            } else {
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
    }

    public function deleteHistoryPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }
            $kode = input::get('kode') ?? '';
            $result = $this->peminjamanService->deleteHistoryPeminjaman($kode);
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
                'message' => 'Success cancel loan',
                'data' => $result
            ]);
            exit(200);
        } catch (Exception $exception) {
            if ($exception instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode([
                    'status' => '500',
                    'error' => $exception->getMessage()
                ]);
                exit(500);
            } else {
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
    }

    public function peminjaman()
    {
        $session = $this->sessionManagerService->get();
        $pengguna = $this->profileService->getProfile($session->id);
        $search = input::get('search') ?? '';
        $peminjaman = $this->peminjamanService->getListPeminjamanWithAvailableStockAndSearch($search);
        View::renderView('inventory/peminjaman/peminjaman', compact('peminjaman', 'pengguna'));
    }

    public function postPeminjaman()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }
            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);
            $request = [
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'StartDate' => input::post('start_date') ?? '',
                'EndDate' => input::post('end_date') ?? '',
                'Deskripsi_Keperluan' => input::post('deskripsi_keperluan') ?? '',
                'items' => json_decode($_POST['items']) ?? []
            ];
            $validate = (new InventarisValidation($request))->validateCheckoutPeminjaman();


            // array_merge($validate->getErrors(), $validateImage->getErrors());

            if (!empty($validate->getErrors())) {
                header('HTTP/1.1 400 Bad Request');
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode([
                    'status' => '400',
                    'error' => $validate->getErrors()
                ]);
                exit(400);
            }



            if ($pengguna->Level->Nama_Level === 'Mahasiswa') {
                $validateImage = (new ImageValidation([
                    'image' => $_FILES['jaminan'] ?? []
                ]))->validate();
                if (!empty($validateImage->getErrors())) {
                    header('HTTP/1.1 400 Bad Request');
                    header('Content-Type: application/json');
                    http_response_code(400);
                    echo json_encode([
                        'status' => '400',
                        'error' => $validateImage->getErrors()
                    ]);
                    exit(400);
                }


                $image = $_FILES['jaminan'];
                $imageName = $this->fileImageService->randomImageName($image);
                $request['Jaminan'] = $imageName;
                if ($this->fileImageService->upload('jaminan', $imageName, $image)) {
                    $result = $this->peminjamanService->createPeminjaman($request);
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
                        'message' => 'Success add loan',
                        'data' => json_encode($result)
                    ]);
                    exit(200);
                } else {
                    unlink($image['tmp_name']);
                    throw new Exception('Failed to upload image');
                }
            } else {
                $request['Jaminan'] = null;
                $result = $this->peminjamanService->createPeminjaman($request);
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
                    'message' => 'Success add loan',
                    'data' => json_encode($result)
                ]);
                exit(200);

            // $image = $_FILES['jaminan'];
            // $imageName = $this->fileImageService->randomImageName($image);
            // $request['Jaminan'] = $imageName;
            // if ($this->fileImageService->upload('jaminan', $imageName, $image)) {
            //     $result = $this->peminjamanService->createPeminjaman($request);
            //     if (empty($result)) {
            //         header('HTTP/1.1 404 Not Found');
            //         header('Content-Type: application/json');
            //         http_response_code(404);
            //         echo json_encode([
            //             'status' => '404',
            //             'error' => 'Data not found'
            //         ]);
            //         exit(404);
            //     }
            //     header('HTTP/1.1 200 OK');
            //     header('Content-Type: application/json');
            //     http_response_code(200);
            //     echo json_encode([
            //         'status' => '200',
            //         'message' => 'Success add loan',
            //         'data' => json_encode($result)
            //     ]);
            //     exit(200);
            }
        } catch (Exception $exception) {
            if ($exception instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode([
                    'status' => '500',
                    'error' => $exception->getMessage()
                ]);
                exit(500);
            } else {
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
    }

    public function riwayat()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }

            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);
            $riwayat = $this->peminjamanService->searchRiwayatDataPeminjamanPengguna($pengguna->ID_Pengguna);

            View::renderView('inventory/riwayat/riwayat', compact('riwayat', 'pengguna'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            }
        }
    }

    public function getListMessage()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }
            $id = input::get('id') ?? '';
            $result = $this->peminjamanService->getListPesan($id);
            if (empty($result)) {
                header('HTTP/1.1 404 Not Found');
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode([
                    'status' => '404',
                    'error' => 'Message not found'
                ]);
                exit(404);
            }
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                'status' => '200',
                'message' => 'Success add loan',
                'data' => $result
            ]);
            exit(200);
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            }
        }
    }

    public function getListDate()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => 'Method not allowed'
                ]);
                exit(405);
            }
            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);
            $result = $this->peminjamanService->getListDate($pengguna->ID_Pengguna);
            if (empty($result)) {
                header('HTTP/1.1 404 Not Found');
                header('Content-Type: application/json');
                http_response_code(404);
                echo json_encode([
                    'status' => '404',
                    'error' => 'Message not found'
                ]);
                exit(404);
            }
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                'status' => '200',
                'message' => 'Success add loan',
                'data' => $result
            ]);
            exit(200);
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            }
        }
    }
}
