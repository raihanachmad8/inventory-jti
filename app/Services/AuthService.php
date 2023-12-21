<?php

require_once __DIR__ . '/../Exceptions/ValidationException.php';

require_once __DIR__ . '/../Repository/OTPRepository.php';
require_once __DIR__ . '/../Repository/LevelRepository.php';
require_once __DIR__ . '/../Services/OTPService.php';
require_once __DIR__ . '/../Services/ProfileService.php';


class AuthService
{
    private PenggunaRepository $penggunaRepository;
    private OTPService $otpService;
    private LevelRepository $levelRepository;
    private ProfileService $profileService;

    public function __construct(PenggunaRepository $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
        $this->otpService = new OTPService(new OTPRepository(DB::connect()));
        $this->levelRepository = new LevelRepository(DB::connect());
        $this->profileService = new ProfileService();
    }

    public function register(array $request): ?Pengguna
    {
        try {

            $this->validateRegistration($request);
            $pengguna = $this->createUser($request);
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
            if ($pengguna->Status === 'TIDAK AKTIF') {
                throw new Exception('Email & Password is incorrect.');
            }
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
        if (!$result) {
            throw new Exception('Failed to create user.');
        }
        return $this->penggunaRepository->getPenggunaById($pengguna->ID_Pengguna);
    }

    private function sendOTP(Pengguna $pengguna): void
    {
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

    public function resendOTP(string $ID_Pengguna): bool
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaById($ID_Pengguna);
            $this->otpService->deleteOTP($pengguna->ID_Pengguna);
            $otp = $this->otpService->createOTP($pengguna->ID_Pengguna, $pengguna->Email);
            if ($otp === null) {
                throw new Exception('Failed to resend OTP.');
            }
            return $otp;
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

    public function forgot(string $email): ?Pengguna
    {
        try {
            $pengguna = $this->penggunaRepository->getPenggunaByEmail($email);
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
            $result = $this->profileService->updateAccountSecurity($request);

            if (!$result) {
                throw new Exception('Failed to reset Password.');
            }
            $pengguna = $this->penggunaRepository->getPenggunaById($request['ID_Pengguna']);
            return $pengguna;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
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
            $pengguna = $this->penggunaRepository->updateStatus($userId, "AKTIF");

            if ($pengguna === null) {
                throw new Exception('Failed to activate account.');
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
