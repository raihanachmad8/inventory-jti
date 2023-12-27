<?php

require_once __DIR__ . '/../Services/FileImageService.php';
require_once __DIR__ . '/../Services/ProfileService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Validation/ImageValidation.php';
require_once __DIR__ . '/../Services/PeminjamanService.php';

class ProfileManagementController
{
    private FileImageService $fileImageService;
    private ProfileService $profileService;
    private SessionManagerService $sessionManagerService;
    private PeminjamanService $peminjamanService;

    public function __construct()
    {
        $this->fileImageService = new FileImageService();
        $this->profileService = new ProfileService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
        $this->peminjamanService = new PeminjamanService();
    }

    public function profile() {
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
            header('HTTP/1.0 200 OK');
            View::renderView('profile/profile', compact('pengguna'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('profile/profile', ['error' => $e->getMessage()]);
            } else {
                View::renderView('profile/profile', ['error' => $e->getMessage()]);
            }
        }
    }

    public function getProfileDetail() {
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
            header('HTTP/1.0 200 OK');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'message' => 'Profile retrieved successfully',
                'data' => $pengguna
            ]);
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                echo json_encode(['error' => $e->getMessage()]);
            } else {
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
    }

    public function postEditProfile() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP/1.0 405 Method Not Allowed');
                throw new Exception('Method not allowed');
            }

            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'Nama_Pengguna' => input::post('nama'),
            ];
            if (empty($request['ID_Pengguna'])) {
                throw new Exception('ID Pengguna must be valid');
            }

            $currentImage = $pengguna->Foto;

            if (!empty($_FILES['foto']['name'])) {
                $image = $_FILES['foto'];
                $imageValidate = (new ImageValidation([
                    'image' => $image
                ]))->validate();
                if ($imageValidate->hasError()) {
                    throw new Exception($imageValidate->getErrors()['image']);
                }
                $imageName = $this->fileImageService->randomImageName($image);
                $request['Foto'] = $imageName;
                if ($this->fileImageService->upload('profile', $imageName, $image)) {

                    $result = $this->profileService->updateUserProfile($request);

                    if (!$result) {
                        unlink($this->fileImageService->getPathImage('profile', $imageName));
                        exit(500);
                    }

                    if (!empty($currentImage)) {
                        unlink($this->fileImageService->getPathImage('profile', $currentImage));
                    }
                    View::setFlashData('success', 'Profile updated successfully');
                    View::redirect('/profile/profile');
                } else {
                    throw new Exception('Failed to upload image');
                }
            } else {
                $request['Foto'] = $pengguna->Foto;
                $result = $this->profileService->updateUserProfile($request);

                if (!$result)  {
                    throw new Exception('Failed to update profile');
                }

                View::setFlashData('success', 'Profile updated successfully');
                View::redirect('/profile/profile');
            }
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            }
        }
    }

    public function postEditPersonal()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP/1.0 405 Method Not Allowed');
                throw new Exception('Method not allowed');
            }

            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'Email' => input::post('email'),
                'Nomor_HP' => input::post('nomor-hp')
            ];
            if (empty($request['ID_Pengguna'])) {
                throw new Exception('ID Pengguna must be valid');
            }
            $validate = (new AuthValidation($request))->validateEmail();
            $validate2 = (new AccountValidation($request))->validatePhone();
            $merge = array_merge($validate2->getErrors(), $validate->getErrors());
            if (!empty($merge)) {
                throw new ValidationException($merge);
            }
            $result = $this->profileService->updateAccountInformation($request);

            if (!$result) {
                throw new Exception('Failed to update account information');
            }
            View::setFlashData('success', 'Account information updated successfully');
            View::redirect('/profile/profile');
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            } else if ($e instanceof ValidationException) {
                header('HTTP/1.1 500 Internal Server Error');
                View::renderView('profile/profile', [
                    'error' => "Failed to update account information",
                    'errors' => $e->getErrors(),
                    'p' => $pengguna
                ]);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            }
        }
    }

    public function postEditSecurity()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP/1.0 405 Method Not Allowed');
                throw new Exception('Method not allowed');
            }

            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'Password' => input::post('password'),
                'Confirm_Password' => input::post('confirm-password')
            ];
            if (empty($request['ID_Pengguna'])) {
                throw new Exception('ID Pengguna must be valid');
            }

            $validate = (new AuthValidation($request))->validatePassword();
            $validate2 = (new AuthValidation($request))->validateConfirmPassword();

            $merge = array_merge($validate2->getErrors(), $validate->getErrors());
            if (!empty($merge)) {
                throw new ValidationException($merge);
            }

            $result = $this->profileService->updateAccountSecurity($request);

            if (!$result) {
                throw new Exception('Failed to update account security');
            }
            View::setFlashData('success', 'Account security updated successfully');
            View::redirect('/profile/profile');
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            } else if ($e instanceof ValidationException) {
                header('HTTP/1.1 500 Internal Server Error');
                View::renderView('profile/profile', [
                    'error' => "Failed to update account security",
                    'errors' => $e->getErrors(),
                    'p' => $pengguna
                ]);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                View::setFlashData('error', $e->getMessage());
                View::redirect('/profile/profile');
            }
        }
    }

    public function security() {
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
            View::renderView('profile/keamanan', compact('pengguna'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('profile/keamanan', ['error' => $e->getMessage()]);
            } else {
                View::renderView('profile/keamanan', ['error' => $e->getMessage()]);
            }
        }
    }



    public function message() {
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
            $message = $this->peminjamanService->getListPesan($session->id);

            View::renderView('profile/pesan', compact('pengguna', 'message'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('profile/pesan', ['error' => $e->getMessage()]);
            } else {
                View::renderView('profile/pesan', ['error' => $e->getMessage()]);
            }
        }
    }
    public function deleteAccount() {
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
            View::renderView('profile/hapus-akun', compact('pengguna'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('profile/hapus-akun', ['error' => $e->getMessage()]);
            } else {
                View::renderView('profile/hapus-akun', ['error' => $e->getMessage()]);
            }
        }
    }

    public function deleteAccountPermament() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
                header('HTTP/1.0 405 Method Not Allowed');
                throw new Exception('Method not allowed');
            }

            $session = $this->sessionManagerService->get();
            $pengguna = $this->profileService->getProfile($session->id);

            if (empty($pengguna->ID_Pengguna)) {
                throw new Exception('ID Pengguna must be valid');
            }

            if ($session->Level === 'Admin') {
                throw new Exception('Admin cannot delete account');
            }

            $result = $this->profileService->deleteAccount($pengguna->ID_Pengguna);

            if (!$result) {
                throw new Exception('Failed to delete account');
            }

            header('HTTP/1.0 201 OK');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'message' => 'Account deleted successfully'
            ]);

        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => $e->getMessage()
                ]);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'failed',
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
