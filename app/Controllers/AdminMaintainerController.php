<?php

require_once __DIR__ . '/../Models/Maintainer.php';
require_once __DIR__ . '/../Services/MaintainerService.php';

class AdminMaintainerController
{
    private MaintainerService $maintainerService;

    public function __construct()
    {
        $this->maintainerService = new MaintainerService();
    }

    public function index()
    {
        try {
            $search = input::get('search') ?? '';
            $maintainers = $this->maintainerService->getMaintainerByNamaLike($search);
            if ($maintainers == null) {
                $maintainers = [];
            }
            View::renderView('admin/maintainer/maintainer', compact('maintainers', 'search'));
        } catch (PDOException $exception) {
            View::renderView('error/500.php');
        } catch (Exception $exception) {
            View::renderView('error/500.php');
        }
    }

    public function postCreate() {
        try {
            $kode = input::post('kode');
            $nama = input::post('nama');
            $maintainer = new Maintainer();
            $maintainer->ID_Maintainer = $kode;
            $maintainer->Nama_Maintainer = $nama;
            $result = $this->maintainerService->create($maintainer);
            if (!$result) {
                http_response_code(500);
                echo 'Failed to save into the database';
                exit(500);;
            }
            http_response_code(201);
            echo 'Success';
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

    public function get()
    {
        // header('Content-Type: application/json');
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $kode = input::get('kode');
                $maintainer = $this->maintainerService->getMaintainerById($kode);
                if ($maintainer == null) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Maintainer not found']);
                    exit(404);
                }
                http_response_code(200);
                echo json_encode(['data' => $maintainer]);
            } else {
                // If it's not a POST request, return an error
                header('HTTP/1.1 405 Method Not Allowed');
                http_response_code(405);
                echo json_encode(['error' => 'Method Not Allowed']);

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

    public function delete () {
        try {
            // Check if it's a DELETE request
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                // Get the kode from the request data
                $kode = input::get('kode');
                $result = $this->maintainerService->delete($kode);
                if (!$result) {
                    // If the delete operation fails, return an error response
                    header('HTTP/1.1 500 Internal Server Error');
                    http_response_code(500);
                    echo 'Failed to delete into the database';
                    exit(500);
                }
                header('HTTP/1.1 200 OK');
                http_response_code(200);
                echo 'success delete';
            } else {
                // If it's not a DELETE request, return an error
                header('HTTP/1.1 405 Method Not Allowed');
                http_response_code(405);
                echo 'Method Not Allowed';
            }
        } catch (Exception $e) {
            // Handle exceptions if necessary
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            echo $e->getMessage();
        }
    }

    public function putUpdate() {
        try {
            // Check if it's a PUT request
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                // Get the kode from the request data
                $input_data = file_get_contents("php://input");
                $data = json_decode($input_data, true);
                $maintainer = new Maintainer();
                $maintainer->ID_Maintainer = $data['kode'];
                $maintainer->Nama_Maintainer = $data['nama'];
                $result = $this->maintainerService->update($maintainer);

                if (!$result) {
                    // If the update operation fails, return an error response
                    header('HTTP/1.1 500 Internal Server Error');
                    http_response_code(500);
                    throw new Exception('Failed to update into the database');
                    exit(500);
                }
                header('HTTP/1.1 200 OK');
                http_response_code(200);
                echo 'success update';
            } else {
                // If it's not a PUT request, return an error
                header('HTTP/1.1 405 Method Not Allowed');
                http_response_code(405);
                throw new Exception('Method Not Allowed');
            }
        } catch (Exception $e) {
            // Handle exceptions if necessary
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            echo $e->getMessage();
        }
    }
}
