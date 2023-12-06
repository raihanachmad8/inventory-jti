<?php

require_once __DIR__ . '/../Exceptions/ValidationException.php';
require_once __DIR__ . '/../Response/UserResponse.php';

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

    public function register(array $request): ?UserResponse
    {
        try {

            $this->validateRegistration($request);
            $pengguna = $this->createUser($request);
            $this->sendOTP($pengguna);
            return new UserResponse($pengguna);
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function login(array $request): ?UserResponse
    {
        try {
            $this->validateLogin($request);
            $pengguna = $this->penggunaRepository->getPenggunaWithLevel(null, null, null, null, null, $request['Email']);
            $this->validatePassword($request['Password'], $pengguna);
            return new UserResponse($pengguna);
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

            $pengguna = $this->penggunaRepository->get($request['ID_Pengguna']);
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

            $pengguna = $this->penggunaRepository->get($request['ID_Pengguna']);
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
        $pengguna = $this->penggunaRepository->get(null, null, null, null, null, $Email);
        if ($pengguna !== null) {
            throw new ValidationException(['Email' => 'Email is already in use.']);
        }
    }

    private function checkIfNomorIdentitasAlreadyExists(string $nomorIdentitas): void
    {
        $pengguna = $this->penggunaRepository->get(null, null, $nomorIdentitas);
        if ($pengguna !== null) {
            throw new ValidationException(['Nomor_Identitas' => 'Nomor Identitas is already in use.']);
        }
    }
    private function createUser(array $request): Pengguna
    {
        $ID_Pengguna = 'Account_ID_' . base64_encode(random_bytes(4) . '-' . base64_encode(random_bytes(8)));
        $Salt = base64_encode(random_bytes(8));
        $Password = $request['Password'] . $request['Nomor_Identitas'] . $Salt;
        $pengguna = new Pengguna([
            'ID_Pengguna' => $ID_Pengguna,
            'ID_Level' => $this->levelRepository->get(null,$request['Role'])->getID(),
            'Nomor_Identitas' => $request['Nomor_Identitas'],
            'Password' => password_hash($Password, PASSWORD_BCRYPT),
            'Nama' => $request['Nama'],
            'Email' => $request['Email'],
            'Nomor_HP' => $request['Nomor_HP'],
            'Status' => $request['Status'],
            'Salt' => $Salt
        ]);
        $result = $this->penggunaRepository->insert($pengguna);
        if (!$result) {
            throw new Exception('Failed to create user.');
        }
        return $this->penggunaRepository->get($pengguna->getID());
    }

    private function sendOTP(Pengguna $pengguna): void
    {
        $otp = $this->otpService->createOTP($pengguna->getID(), $pengguna->Email);

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
        $pengguna = $this->penggunaRepository->get(null, null, null, null, null, $Email);

        if ($pengguna === null) {
            throw new ValidationException(['Email' => 'Email is not registered.']);
        }

        return $pengguna;
    }

    private function validatePassword(string $password, Pengguna $pengguna): void
    {
        if (!password_verify($password . $pengguna->Nomor_Identitas . $pengguna->Salt, $pengguna->Password)) {
            throw new ValidationException(['Password' => 'Password is incorrect.']);
        }
    }

    private function checkIfEmailExists(string $Email): void
    {
        $pengguna = $this->penggunaRepository->get(null, null, null, null, null, $Email);

        if ($pengguna === null) {
            throw new ValidationException(['Email' => 'Email is not registered.']);
        }
    }

    public function getListLevel(): array
    {
        try {
            $levels = $this->levelRepository->getAll();
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
        if ($pengguna->Status === 'TIDAK AKTIF') {
            $this->penggunaRepository->deleteByField('ID_Pengguna', $pengguna->getID());
            $this->penggunaRepository->deleteByField('Email', $pengguna->Email);
        }
    }

    public function resendOTP(string $email): bool
    {
        try {
            $pengguna = $this->penggunaRepository->get(null, null, null, null, null, $email);
            $this->otpService->deleteOTP($pengguna->getID());
            $otp = $this->otpService->createOTP($pengguna->getID(), $pengguna->Email);
            if ($otp === null) {
                throw new Exception('Failed to resend OTP.');
            }
            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function getPenggunaById(string $id): ?UserResponse
    {
        try {
            $pengguna = $this->penggunaRepository->get($id);
            if ($pengguna === null) {
                throw new Exception('User not found.');
            }
            return new UserResponse($pengguna);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function forgot(array $request): ?UserResponse
    {
        try {
            $pengguna = $this->penggunaRepository->get(null, null, null, null, null, $request['Email']);
            if ($pengguna === null) {
                throw new ValidationException(['Email' => 'Email is not registered.']);
            }

            $otp = $this->otpService->createOTP($pengguna->getID(), $pengguna->Email);

            if ($otp === null) {
                throw new Exception('Failed to create OTP.');
            }

            return new UserResponse($pengguna);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function reset(array $request): ?UserResponse
    {
        try {
            $pengguna = $this->penggunaRepository->get($request['ID_Pengguna']);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            $password = $request['Password'] . $pengguna->Nomor_Identitas . $pengguna->Salt;
            $pengguna->Password = password_hash( $password, PASSWORD_BCRYPT);
            $result = $this->penggunaRepository->update($pengguna);

            if ($result === null) {
                throw new Exception('Failed to reset Password.');
            }
            $pengguna = $this->penggunaRepository->get($pengguna->getID());
            return new UserResponse($pengguna);
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function changePassword(string $userId, string $currentPassword, string $newPassword): bool
    {
        try {


            $pengguna = $this->penggunaRepository->get($userId);

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


            $pengguna = $this->penggunaRepository->get($userId);

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


            $pengguna = $this->penggunaRepository->get($userId);

            if ($pengguna === null) {
                throw new Exception('User not found.');
            }

            // Kirim ulang Email aktivasi
            $otp = $this->otpService->createOTP($pengguna->getID(), $pengguna->Email);

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
