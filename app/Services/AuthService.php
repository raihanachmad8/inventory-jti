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

    public function register(AuthRegisterRequest $authRegisterRequest) : ?UserResponse
    {
        try {
            DB::connect()->beginTransaction();
            $request = $authRegisterRequest->validate();
            $user = $this->authRepository->getUserByEmail($authRegisterRequest->request['email']);

            if ($user !== null) {
                $request['email'][] = 'Email is already in use.';
            }
            $user = $this->authRepository->getUserByNomorIdentitas($authRegisterRequest->request['nomor_identitas']);
            if ($user !== null) {
                $request['nomor_identitas'][] = 'Nomor Identitas is already in use.';
            }

            if (!empty($request)) {
                throw new ValidationException($request);
            }

            if ($authRegisterRequest->request['level'] === 'Dosen') {
                $authRegisterRequest->request['id_level'] = 'L2';
            } else {
                $authRegisterRequest->request['id_level'] = 'L3';
            }

            $user = new User([
                'id_level' => $authRegisterRequest->request['id_level'],
                'nomor_identitas' => $authRegisterRequest->request['nomor_identitas'],
                'password' => password_hash($authRegisterRequest->request['password'], PASSWORD_BCRYPT),
                'nama' => $authRegisterRequest->request['nama'],
                'email' => $authRegisterRequest->request['email'],
                'nomor_hp' => $authRegisterRequest->request['nomor_hp']
            ]);
            $user = $this->authRepository->create($user);

            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to create user.');
            }
            $otp = $this->otpService->createOTP($user->id_pengguna, $user->email);
            if ($otp === null) {
                throw new Exception('Failed to create OTP.');
            }
            DB::connect()->commit();
            return $response;
        } catch (ValidationException $e) {
            DB::connect()->rollBack();
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            DB::connect()->rollBack();
            throw new Exception($e->getMessage());
        }
    }



    public function login(AuthLoginRequest $authLoginRequest) : ?UserResponse
    {
        try {
            $request = $authLoginRequest->validate();
            $user = $this->authRepository->getUserByEmail($authLoginRequest->request['email']);
            if ($user === null) {
                $request['email'][] = 'Email is not registered.';
            }
            if (!password_verify($authLoginRequest->request['password'], $user->password)) {
                $request['password'][] = 'Password is incorrect.';
            }
            if (!empty($request)) {
                throw new ValidationException($request);
            }

            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to create user.');
            }
            var_dump($response);
            return $response;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function verifyOTP(OTPVerifyRequest $OTPVerifyRequest) : bool
    {
        try {
            $request = $OTPVerifyRequest->validate();
            if (!empty($request)) {
                throw new ValidationException($request);
            }
            $otp = $this->otpService->verifyOTP($OTPVerifyRequest);
            if ($otp === null) {
                throw new Exception('Failed to verify OTP.');
            }
            return $otp;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function resendOTP(string $userId) : bool
    {
        try {
            $this->otpService->deleteOTP($userId);
            $otp = $this->otpService->createOTP($userId);
            if ($otp === null) {
                throw new Exception('Failed to resend OTP.');
            }
            return $otp;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserById(string $id) : ?UserResponse
    {
        try {
            $user = $this->authRepository->getUserById($id);
            if ($user === null) {
                throw new Exception('User not found.');
            }
            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to get user.');
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUserByNomorIdentitas(string $nomorIdentitas) : ?UserResponse
    {
        try {
            $user = $this->authRepository->getUserByNomorIdentitas($nomorIdentitas);
            if ($user === null) {
                throw new Exception('User not found.');
            }
            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to get user.');
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteUser(UserDeleteValidation $userDeleteValidation) : ?UserResponse
    {
        try {
            $request = $userDeleteValidation->validate();
            if (!empty($userDeleteValidation)) {
                throw new ValidationException($request);
            }
            $user = $this->authRepository->getUserById($userDeleteValidation->request['id_pengguna']);
            if ($user === null) {
                throw new Exception('User not found.');
            }
            $this->authRepository->delete($user->id_pengguna);
            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to delete user.');
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function forgot(AuthMailRequest $authMailRequest) : ?UserResponse
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
            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to send email.');
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function reset(AuthForgotRequest $authForgotRequest) : ?UserResponse
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
            $response = new UserResponse($user);
            if ($response === null) {
                throw new Exception('Failed to reset password.');
            }
            return $response;
        } catch (ValidationException $e) {
            throw new ValidationException($e->getErrors());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
