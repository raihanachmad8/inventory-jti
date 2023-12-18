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
            header('HTTP/1.1 302 Found');
            http_response_code(302);
            View::redirect('/inventory/dashboard');
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
            // $request = [
            //     'ID_Pengguna' => input::post('ID_Pengguna'),
            //     'ID_Level' => input::post('ID_Level'),
            //     'Nomor_Identitas' => input::post('Nomor_Identitas'),
            //     'Nama_Pengguna' => input::post('Nama_Pengguna'),
            //     'Password' => input::post('Password'),
            //     'Confirm_Password' => input::post('Confirm_Password'),
            //     'Email' => input::post('Email'),
            //     'Nomor_HP' => input::post('Nomor_HP'),
            //     'Foto' => input::post('Foto'),
            //     'Status' => input::post('Status'),
            //     'Salt' => input::post('Salt'),
            // ];

            $request = [
                'Role' => input::post('role'),
                'Nomor_Identitas' => input::post('nomor_identitas'),
                'Nama' => input::post('nama'),
                'Nomor_HP' => input::post('nomor_hp'),
                'Email' => input::post('email'),
                'Password' => input::post('password'),
                'Confirm_Password' => input::post('confirm_password'),
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
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'Email' => urlencode($pengguna->Email),
                'o' => $OTPID->getID()
            ]));
        } catch (Exception $e) {
            if ($e instanceof ValidationException) {
                header('HTTP/1.1 400 Bad Request');
                http_response_code(400);
                var_dump($e->getErrors());
                View::renderPage('users/register', [
                    'errors' => $e->getErrors(),
                    'error' => "Registeration Failed"
                ]);
                exit();
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                http_response_code(500);
                var_dump($e->getMessage());
                View::renderPage('users/register', [
                    'error' => $e->getMessage()
                ]);
                exit();
            }
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
            'Email' => input::get('Email',),
        ];
        try {
            $validate = (new AccountValidation($request))->validateIDPengguna();
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $response = $this->authService->resendOTP($request['Email']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if (empty($response)) {
                throw new Exception('Failed to create OTP.');
            }
            View::setFlashData('success', 'OTP was send to your email');
            View::redirect('/users/register/verification?' . http_build_query([
                'ID_Pengguna' => $request['ID_Pengguna'],
                'Email' => input::get('Email',),
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
                'Email' => input::get('Email',),
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
            'Email' => input::get('Email',),
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
            $pengguna = $this->authService->forgot($request);
            $OTPID = $this->authService->getOTPByIdPengguna($pengguna->ID_Pengguna);
            if (empty($pengguna)) {
                throw new Exception('Failed to send Email.');
            }
            View::setFlashData('success', 'Email Sent');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'ID_Pengguna' => $pengguna->ID_Pengguna,
                'Email' => $pengguna->Email,
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
            'Email' => input::get('Email',),
            'o' => input::get('o')
        ];

        try {
            $validate = (new AuthValidation($request))->validateEmail();
            if ($validate->hasError()) {
                throw new ValidationException($validate->getErrors());
            }
            $pengguna = $this->authService->resendOTP($request['Email']);
            $OTPID = $this->authService->getOTPByIdPengguna($request['ID_Pengguna']);
            if (empty($pengguna)) {
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
                'Email' => input::get('Email',),
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
            'Email' => input::get('Email',),
            'Kode' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
        ];

        try {
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
        $this->verifyOTPReset();
        View::renderPage('users/reset');
    }

    public function forgotReset()
    {
        $this->verifyOTPReset();
        $request = [
            'Email' => input::get('Email',),
            'Password' => input::post('Password'),
            'Confirm_Password' => input::post('Confirm_Password')
        ];

        try {
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
                'error' => $e->getErrors()
            ]);
            exit();
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

    private function verifyOTPReset(){
        try {
            $ID_PenggunaInput = input::get('ID_Pengguna');
            $EmailInput = input::get('Email');

            if (empty($ID_PenggunaInput) || empty($EmailInput)) {
                View::setFlashData('error', 'Verification failed. Please provide valid link');
                View::redirect('/users/forgot');
                exit();
            }

            $pengguna = $this->authService->getPenggunaById($ID_PenggunaInput);

            if (empty($pengguna) || $ID_PenggunaInput !== $pengguna->ID_Pengguna) {
                View::setFlashData('error', 'Verification failed. User not found.');
                View::redirect('/users/forgot');
                exit();
            }
            if ($EmailInput !== $pengguna->Email) {
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
            $EmailInput = input::get('Email', true);
            $OTPID = input::get('o');

            if (empty($ID_PenggunaInput) || empty($EmailInput) || empty($OTPID)) {
                View::setFlashData('error', 'Verification failed. Please provide valid link');
                View::redirect($redirect);
                exit();
            }
            $pengguna = $this->authService->getPenggunaById($ID_PenggunaInput);
            $expectedOtpId = $this->authService->getOTPByIdPengguna($ID_PenggunaInput);

            if (empty($pengguna) || $ID_PenggunaInput !== $pengguna->ID_Pengguna) {
                View::setFlashData('error', 'Verification failed. User not found.');
                View::redirect($redirect);
                exit();
            }
            if ($EmailInput !== $pengguna->Email) {
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
