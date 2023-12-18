<?php

require_once __DIR__ . '/../Exceptions/ValidationException.php';

require_once __DIR__ . '/../Repository/OTPRepository.php';
require_once __DIR__ . '/../Repository/LevelRepository.php';
require_once __DIR__ . '/../Services/OTPService.php';


class AuthService
{
    private PenggunaRepository $penggunaRepository;
    private OTPService $otpService;
    private LevelRepository $levelRepository;

    public function __construct(PenggunaRepository $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
        $this->otpService = new OTPService(new OTPRepository(DB::connect()));
        $this->levelRepository = new LevelRepository(DB::connect());
    }

    public function register(array $request): ?Pengguna
    {
        try {

            $this->validateRegistration($request);
            $pengguna = $this->createUser($request);
            // var_dump($pengguna);
            $this->sendOTP($pengguna);
            return $pengguna;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login(array $request): ?Pengguna
    {
        try {
            $this->validateLogin($request);
            $pengguna = $this->penggunaRepository->getDetailPenggunaByEmail($request['Email']);
            $pengguna->Level = $this->levelRepository->getLevelById($pengguna->ID_Level);
            $this->validatePassword($request['Password'], $pengguna);
            return $pengguna;
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOTP(array $request): bool
    {
        try {
            $otp = $this->otpService->verifyOTP($request);
            $changeStatus = $this->penggunaRepository->updateStatus($request['ID_Pengguna']);

            if (!$otp || !$changeStatus) {
                throw new Exception('Failed to verify OTP. lo');
            }

            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            $this->deleteUserRelatedData($pengguna);
            return true;
        } catch (ValidationException $e) {

            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function forgotVerifyOTP(array $request): bool
    {
        try {

            $otp = $this->otpService->verifyOTP($request);

            if (!$otp) {
                throw new Exception('Failed to verify OTP.');
            }

            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            $this->deleteUserRelatedData($pengguna);
            return true;
        } catch (ValidationException $e) {

            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    private function validateRegistration(array $request)
    {
        $this->checkIfEmailAlreadyExists($request['Email']);
        $this->checkIfNomorIdentitasAlreadyExists($request['Nomor_Identitas']);
    }

    private function checkIfEmailAlreadyExists(string $Email): void
    {
        $pengguna = $this->penggunaRepository->getPenggunaByEmail($Email);
        if ($pengguna !== null && $pengguna->Status === 'AKTIF') {
            throw new ValidationException(['Email' => 'Email is already in use.']);
        }
    }

    private function checkIfNomorIdentitasAlreadyExists(string $nomorIdentitas): void
    {
        $pengguna = $this->penggunaRepository->getPenggunaByNomorIdentitas($nomorIdentitas);
        if ($pengguna !== null && $pengguna->Status === 'AKTIF') {
            throw new ValidationException(['Nomor_Identitas' => 'Nomor Identitas is already in use.']);
        }
    }
    private function createUser(array $request): Pengguna
    {
        $ID_Pengguna = 'Account_ID_' . base64_encode(random_bytes(4) . '-' . base64_encode(random_bytes(8)));
        $Salt = base64_encode(random_bytes(8));
        $Password = $request['Password'] . $request['Nomor_Identitas'] . $Salt;
        $pengguna = new Pengguna();
        $pengguna->ID_Pengguna = $ID_Pengguna;
        $pengguna->ID_Level = $this->levelRepository->getLevelByName($request['Role'])->ID_Level;
        $pengguna->Nomor_Identitas = $request['Nomor_Identitas'];
        $pengguna->Password = password_hash($Password, PASSWORD_BCRYPT);
        $pengguna->Nama_Pengguna = $request['Nama'];
        $pengguna->Email = $request['Email'];
        $pengguna->Nomor_HP = $request['Nomor_HP'];
        $pengguna->Status = $request['Status'];
        $pengguna->Salt = $Salt;
        $pengguna->ID_Level = $this->levelRepository->getLevelByName($request['Role'])->ID_Level;
        $pengguna->Foto = 'default.png';
        $result = $this->penggunaRepository->create($pengguna);
        var_dump($pengguna);
        // var_dump($this->penggunaRepository->getPenggunaById($pengguna->ID_Pengguna));
        if (!$result) {
            throw new Exception('Failed to create user.');
        }
        return $this->penggunaRepository->getPenggunaById($pengguna->ID_Pengguna);
    }

    private function sendOTP(Pengguna $pengguna): void
    {
        // var_dump($pengguna);
        $otp = $this->otpService->createOTP($pengguna->ID_Pengguna, $pengguna->Email);

        if ($otp === null) {
            throw new Exception('Failed to create OTP.');
        }
    }

    private function validateLogin(array $request): void
    {
        $this->checkIfEmailExists($request['Email']);
    }

    public function getPenggunaByEmail(string $Email): ?Pengguna
    {
        $pengguna = $this->penggunaRepository->getPenggunaByEmail($Email);

        if (empty($pengguna)  ) {
            // throw new ValidationException(['Email' => 'Email is not registered.']);
            throw new Exception('Email & Password is incorrect.');
        }

        if ($pengguna->Status === 'TIDAK AKTIF') {
            throw new Exception('Email & Password is incorrect.');
        }

        return $pengguna;
    }

    private function validatePassword(string $password, Pengguna $pengguna): void
    {
        if (!password_verify($password . $pengguna->Nomor_Identitas . $pengguna->Salt, $pengguna->Password)) {
            // throw new ValidationException(['Password' => 'Password is incorrect.']);
            throw new Exception('Email & Password is incorrect.');
        }
    }

    private function checkIfEmailExists(string $Email): void
    {
        $pengguna = $this->penggunaRepository->getPenggunaByEmail($Email);

        if ($pengguna === null) {
            throw new ValidationException(['Email' => 'Email is not registered.']);
        }
    }

    public function getListLevel(): array
    {
        try {
            $levels = $this->levelRepository->getListLevel();
            if ($levels === null) {
                throw new Exception('Failed to get list level.');
            }
            return $levels ?? [];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function deleteUserRelatedData(Pengguna $pengguna): void
    {
            $this->penggunaRepository->deleteByField('ID_Pengguna', $pengguna->ID_Pengguna);
            $this->penggunaRepository->deleteByField('Email', $pengguna->Email);
    }

    public function resendOTP(string $email): bool
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaByEmail($email);
            $this->otpService->deleteOTP($pengguna->ID_Pengguna);
            $otp = $this->otpService->createOTP($pengguna->ID_Pengguna, $pengguna->Email);
            if ($otp === null) {
                throw new Exception('Failed to resend OTP.');
            }
            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaById(string $id): ?Pengguna
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($id);
            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            return $pengguna;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function forgot(array $request): ?Pengguna
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaByEmail($request['Email']);
            if ($pengguna === null) {
                throw new ValidationException(['Email' => 'Email is not registered.']);
            }

            $otp = $this->otpService->createOTP($pengguna->ID_Pengguna, $pengguna->Email);

            if ($otp === null) {
                throw new Exception('Failed to create OTP.');
            }

            return $pengguna;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function reset(array $request): ?Pengguna
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            $password = $request['Password'] . $pengguna->Nomor_Identitas . $pengguna->Salt;
            $pengguna->Password = password_hash( $password, PASSWORD_BCRYPT);
            $result = $this->penggunaRepository->update($pengguna);

            if ($result === null) {
                throw new Exception('Failed to reset Password.');
            }
            $pengguna = $this->penggunaRepository->getPenggunaById($pengguna->ID_Pengguna);
            return $pengguna;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function changePassword(string $userId, string $currentPassword, string $newPassword): bool
    {
        try {


            $pengguna = $this->penggunaRepository->getPenggunaById($userId);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            // Verifikasi Password saat ini
            if (!password_verify($currentPassword, $pengguna->Password)) {
                throw new Exception('Current Password not be same with Last Password.');
            }

            // Ubah Password baru
            $pengguna->Password = password_hash($newPassword, PASSWORD_BCRYPT);
            $pengguna = $this->penggunaRepository->update($pengguna);

            if ($pengguna === null) {
                throw new Exception('Failed to change Password.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function activateAccount(string $userId): bool
    {
        try {


            $pengguna = $this->penggunaRepository->getPenggunaById($userId);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            $pengguna->Status = 'AKTIF';
            $pengguna = $this->penggunaRepository->update($pengguna);

            if ($pengguna === null) {
                throw new Exception('Failed to activate account.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function resendActivationEmail(string $userId): bool
    {
        try {


            $pengguna = $this->penggunaRepository->getPenggunaById($userId);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            // Kirim ulang Email aktivasi
            $otp = $this->otpService->createOTP($pengguna->ID_Pengguna, $pengguna->Email);

            if ($otp === null) {
                throw new Exception('Failed to resend activation Email.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function getOTPByIdPengguna(string $idPengguna): ?OTP
    {
        try {
            $otp = $this->otpService->getOTPByIdPengguna($idPengguna);
            if ($otp === null) {
                throw new Exception('OTP not found.');
            }

            return $otp;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
