<?php

require_once __DIR__ . '/../Exceptions/ValidationException.php';
require_once __DIR__ . '/../Response/UserResponse.php';

require_once __DIR__ . '/../Repository/OTPRepository.php';
require_once __DIR__ . '/../Services/OTPService.php';

class AuthService
{
    private AuthRepository $authRepository;
    private OTPService $otpService;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->otpService = new OTPService(new OTPRepository(DB::connect()));
    }

    public function register(AuthRegisterRequest $authRegisterRequest): ?UserResponse
    {
        try {


            $this->validateRegistration($authRegisterRequest);

            $this->setLevelForRegistration($authRegisterRequest);

            $user = $this->createUser($authRegisterRequest);

            $this->sendOTP($user);



            return new UserResponse($user);
        } catch (ValidationException $e) {

            throw $e;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function login(AuthLoginRequest $authLoginRequest): ?UserResponse
    {
        try {
            $this->validateLogin($authLoginRequest);

            $user = $this->getUserByEmail($authLoginRequest->request['email']);

            $this->validatePassword($authLoginRequest->request['password'], $user);

            return new UserResponse($user);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOTP(OTPVerifyRequest $OTPVerifyRequest): bool
    {
        try {


            $this->validateOTPVerification($OTPVerifyRequest);

            $otp = $this->otpService->verifyOTP($OTPVerifyRequest);
            $changeStatus = $this->authRepository->updateStatus($OTPVerifyRequest->id_pengguna);

            if (!$otp || !$changeStatus) {
                throw new Exception('Failed to verify OTP.');
            }

            $user = $this->authRepository->getUserById($OTPVerifyRequest->id_pengguna);
            $this->deleteUserRelatedData($user);



            return true;
        } catch (ValidationException $e) {

            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    // Fungsi-fungsi tambahan

    private function validateRegistration(AuthRegisterRequest $authRegisterRequest): void
    {
        $request = $authRegisterRequest->validate();

        $this->checkIfEmailAlreadyExists($authRegisterRequest->request['email']);
        $this->checkIfNomorIdentitasAlreadyExists($authRegisterRequest->request['nomor_identitas']);

        if (!empty($request)) {
            throw new ValidationException($request);
        }
    }

    private function setLevelForRegistration(AuthRegisterRequest $authRegisterRequest): void
    {
        $authRegisterRequest->request['id_level'] = ($authRegisterRequest->request['level'] === 'Dosen') ? 'L2' : 'L3';
    }

    private function createUser(AuthRegisterRequest $authRegisterRequest): User
    {
        $salt = base64_encode(random_bytes(8));
        $password = $authRegisterRequest->request['password'] . $authRegisterRequest->request['nomor_identitas'] . $salt;
        $user = new User([
            'id_level' => $authRegisterRequest->request['id_level'],
            'nomor_identitas' => $authRegisterRequest->request['nomor_identitas'],
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'nama' => $authRegisterRequest->request['nama'],
            'email' => $authRegisterRequest->request['email'],
            'nomor_hp' => $authRegisterRequest->request['nomor_hp'],
            'foto' => $authRegisterRequest->request['foto'],
            'status' => 'TIDAK AKTIF',
            'salt' => $salt
        ]);

        return $this->authRepository->create($user);
    }

    private function sendOTP(User $user): void
    {
        $otp = $this->otpService->createOTP($user->id_pengguna, $user->email);

        if ($otp === null) {
            throw new Exception('Failed to create OTP.');
        }
    }

    private function validateLogin(AuthLoginRequest $authLoginRequest): void
    {
        $request = $authLoginRequest->validate();
        $this->checkIfEmailExists($authLoginRequest->request['email']);

        if (!empty($request)) {
            throw new ValidationException($request);
        }
    }

    private function getUserByEmail(string $email): ?User
    {
        $user = $this->authRepository->getUserByEmail($email);

        if ($user === null) {
            throw new Exception('Email is not registered.');
        }

        return $user;
    }

    private function validatePassword(string $password, User $user): void
    {
        if (!password_verify($password, $user->password)) {
            throw new ValidationException(['password' => 'Password is incorrect.']);
        }
    }

    private function validateOTPVerification(OTPVerifyRequest $OTPVerifyRequest): void
    {
        $request = $OTPVerifyRequest->validate();

        if (!empty($request)) {
            throw new ValidationException($request);
        }
    }

    private function checkIfEmailExists(string $email): void
    {
        $user = $this->authRepository->getUserByEmail($email);

        if ($user === null) {
            throw new ValidationException(['email' => 'Email is not registered.']);
        }
    }

    private function checkIfEmailAlreadyExists(string $email): void
    {
        $user = $this->authRepository->getUserByEmail($email);

        if ($user !== null) {
            throw new ValidationException(['email' => 'Email is already in use.']);
        }
    }

    private function checkIfNomorIdentitasAlreadyExists(string $nomorIdentitas): void
    {
        $user = $this->authRepository->getUserByNomorIdentitas($nomorIdentitas);

        if ($user !== null) {
            throw new ValidationException(['nomor_identitas' => 'Nomor Identitas is already in use.']);
        }
    }

    private function deleteUserRelatedData(User $user): void
    {
        if ($user->status === 'TIDAK AKTIF') {
            $this->authRepository->deleteByNomorIdentitas($user->nomor_identitas);
            $this->authRepository->deleteByEmail($user->email);
        }
    }

    public function resendOTP(string $userId): bool
    {
        try {


            $this->otpService->deleteOTP($userId);
            $otp = $this->otpService->createOTP($userId);

            if ($otp === null) {
                throw new Exception('Failed to resend OTP.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function getUserById(string $id): ?UserResponse
    {
        try {
            $user = $this->authRepository->getUserById($id);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            return new UserResponse($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserByNomorIdentitas(string $nomorIdentitas): ?UserResponse
    {
        try {
            $user = $this->authRepository->getUserByNomorIdentitas($nomorIdentitas);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            return new UserResponse($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteUser(UserDeleteValidation $userDeleteValidation): ?UserResponse
    {
        try {
            $request = $userDeleteValidation->validate();

            if (!empty($request)) {
                throw new ValidationException($request);
            }

            $user = $this->authRepository->getUserById($userDeleteValidation->request['id_pengguna']);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            $this->authRepository->delete($user->id_pengguna);

            return new UserResponse($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function forgot(AuthMailRequest $authMailRequest): ?UserResponse
    {
        try {
            $request = $authMailRequest->validate();
            $user = $this->authRepository->getUserByEmail($authMailRequest->request['email']);

            if ($user === null) {
                $request['email'][] = 'Email is not registered.';
            }

            if (!empty($request)) {
                throw new ValidationException($request);
            }

            $otp = $this->otpService->createOTP($user->id_pengguna, $user->email);

            if ($otp === null) {
                throw new Exception('Failed to create OTP.');
            }

            return new UserResponse($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function reset(AuthForgotRequest $authForgotRequest): ?UserResponse
    {
        try {
            $request = $authForgotRequest->validate();

            if (!empty($request)) {
                throw new ValidationException($request);
            }

            $user = $this->authRepository->getUserById($authForgotRequest->request['id_pengguna']);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            $user->password = password_hash($authForgotRequest->request['password'], PASSWORD_BCRYPT);
            $user = $this->authRepository->update($user);

            if ($user === null) {
                throw new Exception('Failed to reset password.');
            }

            return new UserResponse($user);
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function changePassword(string $userId, string $currentPassword, string $newPassword): bool
    {
        try {


            $user = $this->authRepository->getUserById($userId);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            // Verifikasi password saat ini
            if (!password_verify($currentPassword, $user->password)) {
                throw new Exception('Current password is incorrect.');
            }

            // Ubah password baru
            $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
            $user = $this->authRepository->update($user);

            if ($user === null) {
                throw new Exception('Failed to change password.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function activateAccount(string $userId): bool
    {
        try {


            $user = $this->authRepository->getUserById($userId);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            $user->status = 'AKTIF';
            $user = $this->authRepository->update($user);

            if ($user === null) {
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


            $user = $this->authRepository->getUserById($userId);

            if ($user === null) {
                throw new Exception('User not found.');
            }

            // Kirim ulang email aktivasi
            $otp = $this->otpService->createOTP($user->id_pengguna, $user->email);

            if ($otp === null) {
                throw new Exception('Failed to resend activation email.');
            }



            return true;
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

}
