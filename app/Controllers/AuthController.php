<?php

require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/PenggunaRepository.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';

require_once __DIR__ . '/../Validation/AccountValidation.php';
require_once __DIR__ . '/../Validation/AuthValidation.php';
require_once __DIR__ . '/../Validation/OTPValidation.php';

class AuthController
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
        try {
            if ($this->sessionManagerService->get()) {
                header('HTTP/1.1 302 Found');
                http_response_code(302);
                View::redirect('/inventory/dashboard');
            }
            header('HTTP/1.1 200 OK');
            http_response_code(200);
            return View::renderPage('users/login');
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            View::renderPage('500', [
                'message' => $e->getMessage()
            ]);
            exit();
        }
    }
    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Method not allowed');
            }
            $request = [
                'Email' => input::post('email'),
                'Password' => input::post('password'),
            ];

            $validate = (new AuthValidation($request))->validateLogin();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $pengguna = $this->authService->login($request);
            $this->sessionManagerService->create($pengguna->ID_Pengguna, $pengguna->Nomor_Identitas, $pengguna->Level->Nama_Level);
            $session = $this->sessionManagerService->get();
            header('HTTP/1.1 302 Found');
            http_response_code(302);
            if ($session->Level === 'Admin') {
                View::redirect('/admin/dashboard');
            } else if (in_array($session->Level, ['Dosen', 'Mahasiswa'])) {
                View::redirect('/inventory/dashboard');
            }
        } catch (Exception $e) {
            if ($e instanceof ValidationException) {
                header('HTTP/1.1 400 Bad Request');
                http_response_code(400);
                View::renderPage('users/login', [
                    'error' => "Login Failed",
                    'errors' => $e->getErrors()
                ]);
                exit();
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/login', [
                    'error' => $e->getMessage()
                ]);
                exit();
            }
        }
    }

    public function logout(): void
    {
        try {
            $this->sessionManagerService->destroy($this->sessionManagerService->get()->id);
            header('HTTP/1.1 302 Found');
            http_response_code(302);
            View::redirect('/');
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            View::renderPage('500', [
                'error' => $e->getMessage()
            ]);
            exit();
        }
    }

    public function registerForm()
    {
        try {
            if ($this->sessionManagerService->get()) {
                header('HTTP/1.1 302 Found');
                http_response_code(302);
                View::redirect('/inventory/dashboard');
            }
            header('HTTP/1.1 200 OK');
            http_response_code(200);
            return View::renderPage('users/register');
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            View::renderPage('500', [
                'error' => $e->getMessage()
            ]);
            exit();
        }
    }


    public function register()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('HTTP/1.1 405 Method Not Allowed');
                http_response_code(405);
                throw new Exception('Method not allowed');
            }
            $request = [
                'Role' => input::post('role'),
                'Nomor_Identitas' => input::post('nomor-identitas'),
                'Nama' => input::post('nama'),
                'Nomor_HP' => input::post('nomor-telepon'),
                'Email' => input::post('email'),
                'Password' => input::post('password'),
                'Confirm_Password' => input::post('confirm-password'),
                'Status' => 'TIDAK AKTIF'
            ];
            $validate = (new AccountValidation($request))->validate();
            $validate2 = (new AuthValidation($request))->validate();
            $merge = array_merge($validate2->getErrors(), $validate->getErrors());
            if (!empty($merge)) {
                throw new ValidationException($merge);
            }

            $pengguna = $this->authService->register($request);
            $OTPID = $this->authService->getOTPByIdPengguna($pengguna->ID_Pengguna);
            header('HTTP/1.1 302 Found');
            http_response_code(302);
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => urlencode($pengguna->ID_Pengguna),
                'Email' => urlencode($pengguna->Email),
                'o' => $OTPID->getID()
            ]));
        } catch (Exception $e) {
            if ($e instanceof ValidationException) {
                header('HTTP/1.1 400 Bad Request');
                http_response_code(400);
                View::renderPage('users/register', [
                    'errors' => $e->getErrors(),
                    'error' => "Registeration Failed"
                ]);
                exit();
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/register', [
                    'error' => $e->getMessage()
                ]);
                exit();
            }
        }
    }

    public function verifyOTPForm()
    {
        try {
            $this->verifyIsUser('/users/register');
            $this->hasOTP('/users/register');
            View::renderPage('users/verify-otp', [
                'title' => 'Verify OTP'
            ]);
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/verify-otp', [
                    'error' => $e->getMessage()
                ]);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/verify-otp', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

    public function resendOTP()
    {

        try {
            $this->verifyIsUser('/users/register');
            $request = [
                'ID_Pengguna' => input::get('ID_Pengguna', true),
                'Email' => input::get('Email', true),
            ];
            $validate = (new AccountValidation($request))->validateIDPengguna();
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->resendOTP($request['ID_Pengguna']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if (empty($response)) {
                throw new Exception('Failed to create OTP.');
            }
            View::setFlashData('success', 'OTP was send to your email');
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => $OTPID->getID()
            ]));
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::setFlashData('error', $e->getMessage());
                View::redirect('/users/register/verification?' . http_build_query([
                    'ID_Pengguna' => input::get('ID_Pengguna'),
                    'Email' => input::get('Email',),
                    'o' => input::get('o')
                ]));
            } else if ($e instanceof ValidationException) {
                header('HTTP/1.1 400 Bad Request');
                http_response_code(400);
                View::setFlashData('error', $e->getErrors()[0]);
                View::redirect('/users/register/verification?' . http_build_query([
                    'ID_Pengguna' => input::get('ID_Pengguna'),
                    'Email' => input::get('Email',),
                    'o' => input::get('o')
                ]));
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::setFlashData('error', $e->getMessage());
                View::redirect('/users/register/verification?' . http_build_query([
                    'ID_Pengguna' => input::get('ID_Pengguna'),
                    'Email' => input::get('Email',),
                    'o' => input::get('o')
                ]));
            }
        }
    }

    public function verifyOTP()
    {

        try {
            $this->verifyIsUser('/users/register');
            $this->hasOTP('/users/register/verification');
            $request = [
                'ID_Pengguna' => input::get('ID_Pengguna',true),
                'Email' => input::get('Email', true),
                'Kode' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
            ];
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
            View::renderPage('users/verify-otp', [
                'error' => $e->getErrors()
            ]);
            exit();
        } catch (Exception $e) {
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email',),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotForm()
    {   try {
            View::renderPage('users/forgot');
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            View::renderPage('500', [
                'error' => $e->getMessage()
            ]);
            exit();
        }
    }

    public function forgot()
    {

        try {
            $request = [
                'Email' => input::post('email')
            ];
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $pengguna = $this->authService->forgot($request['Email']);
            $OTPID = $this->authService->getOTPByIdPengguna($pengguna->ID_Pengguna);
            if (empty($pengguna)) {
                throw new Exception('Failed to send Email.');
            }
            View::setFlashData('success', 'Email Sent');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => urlencode($pengguna->ID_Pengguna),
                'Email' => urlencode($pengguna->Email),
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
        try {
            $this->verifyIsUser('/users/forgot');
            $this->hasOTP('/users/forgot/verification');
            View::renderPage('users/verify-forgot-otp', [
                'title' => 'Verify OTP'
            ]);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            http_response_code(500);
            View::renderPage('500', [
                'error' => $e->getMessage()
            ]);
            exit();
        }
    }

    public function forgotVerifyResend()
    {

        try {
            $this->verifyIsUser('/users/forgot');
            $request = [
                'ID_Pengguna' => input::get('ID_Pengguna', true),
                'Email' => input::get('Email', true),
                'o' => input::get('o')
            ];
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $pengguna = $this->authService->resendOTP($request['ID_Pengguna']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if (empty($pengguna)) {
                throw new Exception('Failed to create OTP.');
            }
            View::setFlashData('success', 'OTP was send to your email');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email'),
                'o' => $OTPID->getID()
            ]));
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to resend OTP');
            View::renderPage('users/verify-forgot-otp', [
                'errors' => $e->getErrors(),
                'title' => 'Verify OTP',
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email',),
                'o' => input::get('o')
            ]);
            exit();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email',),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotVerify()
    {

        try {
            $this->verifyIsUser('/users/forgot');
            $this->hasOTP('/users/forgot/verification');
            $request = [
                'ID_Pengguna' => input::get('ID_Pengguna', true),
                'Email' => input::get('Email', true),
                'Kode' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
            ];
            $validate = (new OTPValidation($request))->validate();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $pengguna = $this->authService->forgotVerifyOTP($request);

            if (empty($pengguna)) {
                throw new Exception('Failed to verification OTP.');
            }
            View::setFlashData('success', 'OTP Verified');
            View::redirect('/users/forgot/reset?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email',),
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
                'Email' => input::get('Email',),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotResetForm()
    {
        try {
            $this->verifyIsUser('/users/forgot');
            View::renderPage('users/reset');
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
            View::redirect('/users/forgot/reset?' . http_build_query([
                'ID_Pengguna' => input::get('ID_Pengguna'),
                'Email' => input::get('Email',),
                'o' => input::get('o')
            ]));
            exit();
        }
    }

    public function forgotReset()
    {

        try {
            $this->verifyIsUser('/users/forgot');
            $request = [
                'ID_Pengguna' => input::get('ID_Pengguna', true),
                'Email' => input::get('Email', true),
                'Password' => input::post('password'),
                'Confirm_Password' => input::post('confirm-password')
            ];
            $validate = (new AuthValidation($request))->validateForgotPassword();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->reset($request);
            if (empty($response)) {
                throw new Exception('Failed to reset Password.');
            }
            View::setFlashData('success', 'Password Reset');
            View::redirect('/users/login');
        } catch (ValidationException $e) {
            View::setFlashData('error', 'Failed to reset Password');
            View::renderPage('users/reset', [
                'error' => 'Failed to reset Password',
                'errors' => $e->getErrors()
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

    private function verifyIsUser($redirect = '/users/register')
    {
        try {
            $ID_PenggunaInput = input::get('ID_Pengguna' , true);
            $EmailInput = input::get('Email', true);
            if (empty($ID_PenggunaInput) || empty($EmailInput) ) {
                throw new Exception('Verification failed. Please provide valid link');
            }
            $pengguna = $this->authService->getPenggunaById($ID_PenggunaInput);

            if (empty($pengguna) || $ID_PenggunaInput !== $pengguna->ID_Pengguna) {
                throw new Exception('Verification failed. ID Pengguna not found.');
            }
            if ($EmailInput !== $pengguna->Email) {
                throw new Exception('Verification failed. Email not found.');
            }


        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::setFlashData('error', $e->getMessage());
                View::redirect($redirect);
                exit();
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::setFlashData('error', $e->getMessage());
                View::redirect($redirect);
                exit();
            }
        }
    }

    public function hasOTP() {
        try {
            $OTPID = input::get('o');
            if (empty($OTPID)) {
                header('HTTP/1.1 404 Not Found');
                http_response_code(404);
                View::renderPage('users/verify-otp', [
                    'error' => 'Verification failed. Please provide valid link'
                ]);
                exit();
            }

            $expectedOtpId = $this->authService->getOTPByIdPengguna(input::get('ID_Pengguna'));
            if ($OTPID !== $expectedOtpId->getID()) {
                header('HTTP/1.1 404 Not Found');
                http_response_code(404);
                View::renderPage('users/verify-otp', [
                    'error' => 'Verification failed. Please provide valid link'
                ]);
                exit();
            }
        } catch (Exception $e) {
            if ($e instanceof PDOException) {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/verify-otp', [
                    'error' => $e->getMessage()
                ]);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                View::renderPage('users/verify-otp', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

}
