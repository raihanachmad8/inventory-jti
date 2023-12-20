<?php

require_once __DIR__ . '/../Services/FileImageService.php';
require_once __DIR__ . '/../Services/ProfileService.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Validation/ImageValidation.php';

class ProfileManagementController
{
    private FileImageService $fileImageService;
    private ProfileService $profileService;
    private SessionManagerService $sessionManagerService;

    public function __construct()
    {
        $this->fileImageService = new FileImageService();
        $this->profileService = new ProfileService();
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
    }

    public function profile() {
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
            $session = $this->sessionManagerService->get();
            $profile = $this->profileService->getProfile($session->id);
            header('HTTP/1.0 200 OK');
            View::renderView('profile/profile', compact('profile'));
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
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }
            $session = $this->sessionManagerService->get();
            $profile = $this->profileService->getProfile($session->id);
            header('HTTP/1.0 200 OK');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $profile
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
            $profile = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $profile->ID_Pengguna,
                'Nama_Pengguna' => input::post('nama'),
            ];
            if (empty($request['ID_Pengguna'])) {
                throw new Exception('ID Pengguna must be valid');
            }

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

                    $profile = $this->profileService->updateUserProfile($request);

                    if (!$profile) {
                        unlink($this->fileImageService->getPathImage('profile', $imageName));
                        exit(500);
                    }
                    View::setFlashData('success', 'Profile updated successfully');
                    View::redirect('/profile/profile');
                } else {
                    throw new Exception('Failed to upload image');
                }
            } else {
                $request['Foto'] = $profile->Foto;
                $profile = $this->profileService->updateUserProfile($request);

                if (!$profile)  {
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
            $profile = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $profile->ID_Pengguna,
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
                    'profile' => $profile
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
            $profile = $this->profileService->getProfile($session->id);

            $request = [
                'ID_Pengguna' => $profile->ID_Pengguna,
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
                    'profile' => $profile
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
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }
            $session = $this->sessionManagerService->get();
            $profile = $this->profileService->getProfile($session->id);
            View::renderView('profile/keamanan', compact('profile'));
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
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }

            View::renderView('profile/pesan');
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
                    'message' => 'Method not allowed'
                ]);
                exit(405);
            }
            $session = $this->sessionManagerService->get();
            $profile = $this->profileService->getProfile($session->id);
            View::renderView('profile/hapus-akun', compact('profile'));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                View::renderView('profile/hapus-akun', ['error' => $e->getMessage()]);
            } else {
                View::renderView('profile/hapus-akun', ['error' => $e->getMessage()]);
            }
        }
    }
}
