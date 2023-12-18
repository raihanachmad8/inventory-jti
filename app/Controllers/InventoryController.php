<?php

require_once __DIR__ . '/../Services/InventarisirService.php';
require_once __DIR__ . '/../Services/PeminjamanService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';

class InventoryController
{
    private InventarisirService $inventarisirService;
    private PeminjamanService $peminjamanService;
    private SessionManagerService $sessionManagerService;

    public function __construct()
    {
        $this->inventarisirService = new InventarisirService();
        $this->peminjamanService = new PeminjamanService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());

    }

    public function dashboard()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }

            // $inventory = $this->peminjamanService->searchPeminjamanByPengguna();
            $pengguna = $this->sessionManagerService->get();
            $peminjaman = $this->peminjamanService->searchPeminjamanByPengguna($pengguna->id);
            $status = $this->peminjamanService->getListStatusPeminjamanPengguna($pengguna->id);
            $stok = $this->peminjamanService->availableStok();
            View::renderView('inventory/dashboard/dashboard', compact('peminjaman', 'status', 'stok'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/dashboard/dashboard', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/dashboard/dashboard', ['error' => $e->getMessage()]);
            }
        }
    }

    public function historyPeminjaman() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Method not allowed'
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

    public function deleteHistoryPeminjaman() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                http_response_code(405);
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Method not allowed'
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
        View::renderView('inventory/peminjaman/peminjaman');
    }

    public function riwayat()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
                header('HTTP/1.0 405 Method Not Allowed');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }

            $pengguna = $this->sessionManagerService->get();
            $riwayat = $this->peminjamanService->searchRiwayatDataPeminjamanPengguna($pengguna->id);

            View::renderView('inventory/riwayat/riwayat', compact('riwayat'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            } else {
                View::renderView('inventory/riwayat/riwayat', ['error' => $e->getMessage()]);
            }
        }
    }

    public function profil()
    {
        View::renderView('profile/profile');
    }
    public function keamanan()
    {
        View::renderView('profile/keamanan');
    }
    public function pesan()
    {
        View::renderView('profile/pesan');
    }
    public function hapusAkun()
    {
        View::renderView('profile/hapus-akun');
    }
}
