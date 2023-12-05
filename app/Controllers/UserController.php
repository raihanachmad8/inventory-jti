<?php

require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/PenggunaRepository.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';

require_once __DIR__ . '/../Validation/AccountValidation.php';
require_once __DIR__ . '/../Validation/AuthValidation.php';
require_once __DIR__ . '/../Validation/OTPValidation.php';

class UserController
{
    private AuthService $authService;
    private SessionManagerService $sessionManagerService;

    public function __construct()
    {
        $this->authService = new AuthService(new PenggunaRepository(DB::connect()));
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
    }

    public function loginForm()
    {
        View::renderPage('users/login');
    }
    public function login()
    {
        $request = [
            'Email' => input::post('Email'),
            'Password' => input::post('Password'),
        ];

        try {
            $validate = (new AuthValidation($request))->validateLogin();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->login($request);
            $this->sessionManagerService->create($response->pengguna->getID(), $response->pengguna->Nomor_Identitas, $response->pengguna->Level->Nama);
            View::setFlashData('success', 'Login Success');
            View::redirect('/inventory/dashboard');
        } catch (ValidationException $e) {
            View::setFlashData('error', "Failed to login");
            View::renderPage('users/login', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/login');
            exit();
        }
    }

    public function logout(): void
    {
        try {
            $this->sessionManagerService->destroy($this->sessionManagerService->get()->id);
            View::redirect('/');
        } catch (Exception $e) {
            View::renderPage('error/500', [
                'message' => $e->getMessage()
            ]);
            exit();
        }
    }

    public function registerForm()
    {
        return View::renderPage('users/register');
    }


    public function register()
    {
        $request = [
            'Nomor_Identitas' => input::post('Nomor_Identitas'),
            'Nama' => input::post('Nama'),
            'Email' => input::post('Email'),
            'Nomor_HP' => input::post('Nomor_HP'),
            'Role' => input::post('Role'),
            'Password' => input::post('Password'),
            'Confirm_Password' => input::post('Confirm_Password'),
            'Status' => 'TIDAK AKTIF'
        ];
        try {
            $validate = (new AccountValidation($request))->validate();
            $validate2 = (new AuthValidation($request))->validate();
            $merge = array_merge($validate2->getErrors(), $validate->getErrors());
            if (!empty($merge)) {
                throw new ValidationException($merge);
            }

            $response = $this->authService->register($request);
            $OTPID = $this->authService->getOTPByIdPengguna($response->pengguna->getID());
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => $response->pengguna->getID(),
                'Email' => $response->pengguna->Email,
                'o' => $OTPID->getID()
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', "Registeration Failed");
            View::renderPage('users/register', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/register');
            exit();
        }
    }

    public function verifyOTPForm()
    {
        $this->verifyIsUser();
        View::renderPage('users/verify-otp', [
            'title' => 'Verify OTP'
        ]);
    }

    public function resendOTP()
    {
        $this->verifyIsUser();
        $request = [
            'ID_Pengguna' => input::get('ID_Pengguna'),
            'Email' => input::get('Email'),
        ];
        try {
            $validate = (new AccountValidation($request))->validateIDPengguna();
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->resendOTP($request['Email']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if ($response === null) {
                throw new Exception('Failed to create OTP.');
            }
            View::setFlashData('success', 'OTP was send to your email');
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => $request['ID_Pengguna'],
                'Email' => input::get('Email'),
                'o' => $OTPID->getID()
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to resend OTP');
            View::renderPage('users/verify-otp', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function verifyOTP()
    {
        $this->verifyIsUser();
        $request = [
            'ID_Pengguna' => input::get('ID_Pengguna'),
            'Email' => input::get('Email'),
            'Kode' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
        ];

        try {
            $validate = (new OTPValidation($request))->validate();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->verifyOTP($request);
            if ($response !== true) {
                throw new Exception('Failed to verification OTP.');
            }
            View::setFlashData('success', 'Register Success');
            View::redirect('/users/login');
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to verification OTP');
            View::renderPage('users/verify-otp', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotForm()
    {
        View::renderPage('users/forgot');
    }

    public function forgot()
    {
        $request = [
            'Email' => input::post('Email')
        ];

        try {
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->forgot($request);
            $OTPID = $this->authService->getOTPByIdPengguna($response->pengguna->getID());
            if ($response === null) {
                throw new Exception('Failed to send Email.');
            }
            View::setFlashData('success', 'Email Sent');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => $response->pengguna->getID(),
                'Email' => $response->pengguna->Email,
                'o' => $OTPID->getID()
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to send Email');
            View::renderPage('users/forgot', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot');
            exit();
        }
    }

    public function forgotVerifyForm()
    {
        View::renderPage('users/verify-forgot-otp', [
            'title' => 'Verify OTP'
        ]);
    }

    public function forgotVerifyResend()
    {
        $this->verifyOTPReset('/users/forgot');
        $request = [
            'ID_Pengguna' => input::get('ID_Pengguna'),
            'Email' => input::get('Email'),
            'o' => input::get('o')
        ];

        try {
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->resendOTP($request['Email']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if ($response === null) {
                throw new Exception('Failed to create OTP.');
            }
            View::setFlashData('success', 'OTP was send to your email');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => $request['ID_Pengguna'],
                'Email' => $request['Email'],
                'o' => $OTPID->getID()
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to resend OTP');
            View::renderPage('users/verify-forgot-otp', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotVerify()
    {
        $this->verifyOTPReset();
        $request = [
            'ID_Pengguna' => input::get('ID_Pengguna'),
            'Email' => input::get('Email'),
            'Kode' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
        ];

        try {
            $validate = (new OTPValidation($request))->validate();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->forgotVerifyOTP($request);

            if ($response !== true) {
                throw new Exception('Failed to verification OTP.');
            }
            View::setFlashData('success', 'OTP Verified');
            View::redirect('/users/forgot/reset?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to verification OTP');
            View::renderPage('users/verify-forgot-otp', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotResetForm()
    {
        $this->verifyOTPReset();
        View::renderPage('users/reset');
    }

    public function forgotReset()
    {
        $this->verifyOTPReset();
        $request = [
            'Email' => input::get('Email'),
            'Password' => input::post('Password'),
            'Confirm_Password' => input::post('Confirm_Password')
        ];

        try {
            $validate = (new AuthValidation($request))->validateForgotPassword();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->reset($request);
            if ($response === null) {
                throw new Exception('Failed to reset Password.');
            }
            View::setFlashData('success', 'Password Reset');
            View::redirect('/users/login');
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to reset Password');
            View::renderPage('users/reset', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot/reset?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    private function verifyOTPReset(){
        try {
            $ID_PenggunaInput = input::get('ID_Pengguna');
            $EmailInput = input::get('Email');

            if (empty($ID_PenggunaInput) || empty($EmailInput)) {
                View::setFlashData('error', 'Verification failed. Please provide valid link');
                View::redirect('/users/forgot');
                exit();
            }

            $response = $this->authService->getPenggunaById($ID_PenggunaInput);

            if (!$response->pengguna || $ID_PenggunaInput !== $response->pengguna->getID()) {
                View::setFlashData('error', 'Verification failed. User not found.');
                View::redirect('/users/forgot');
                exit();
            }
            if ($EmailInput !== $response->pengguna->Email) {
                View::setFlashData('error', 'Verification failed. Email does not match.');
                View::redirect('/users/forgot');
                exit();
            }
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot');
            exit();
        }
    }
    private function verifyIsUser($redirect = '/users/register')
    {
        try {
            $ID_PenggunaInput = input::get('ID_Pengguna');
            $EmailInput = input::get('Email');
            $OTPID = input::get('o');

            if (empty($ID_PenggunaInput) || empty($EmailInput) || empty($OTPID)) {
                View::setFlashData('error', 'Verification failed. Please provide valid link');
                View::redirect($redirect);
                exit();
            }

            $response = $this->authService->getPenggunaById($ID_PenggunaInput);
            $expectedOtpId = $this->authService->getOTPByIdPengguna($ID_PenggunaInput);

            if (!$response->pengguna || $ID_PenggunaInput !== $response->pengguna->getID()) {
                View::setFlashData('error', 'Verification failed. User not found.');
                View::redirect($redirect);
                exit();
            }
            if ($EmailInput !== $response->pengguna->Email) {
                View::setFlashData('error', 'Verification failed. Email does not match.');
                View::redirect($redirect);
                exit();
            }

            if ($OTPID !== $expectedOtpId->getID()) {
                View::setFlashData('error', 'Verification failed. Invalid OTP ID.');
                View::redirect($redirect);
                exit();
            }
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect($redirect);
            exit();
        }
    }

}
