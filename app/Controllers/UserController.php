<?php

require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Repository/AuthRepository.php';
require_once __DIR__ . '/../Services/SessionManagerService.php';
require_once __DIR__ . '/../Repository/SessionManagerRepository.php';
require_once __DIR__ . '/../Validation/AuthRegisterRequest.php';
require_once __DIR__ . '/../Validation/AuthLoginRequest.php';
require_once __DIR__ . '/../Validation/AuthMailRequest.php';
require_once __DIR__ . '/../Validation/AuthForgotRequest.php';
require_once __DIR__ . '/../Validation/OTPVerifyRequest.php';

class UserController
{
    private AuthService $authService;
    private SessionManagerService $sessionManagerService;

    public function __construct()
    {
        $this->authService = new AuthService(new AuthRepository(DB::connect()));
        $this->sessionManagerService = new SessionManagerService(new SessionManagerRepository());
    }

    public function registerForm()
    {
        return View::renderPage('users/register');
    }

    public function loginForm()
    {
        View::renderPage('users/login');
    }

    public function register()
    {
        $err = [];
        $request = new AuthRegisterRequest([
            'nomor_identitas' => input::post('nomor_identitas'),
            'nama' => input::post('nama'),
            'email' => input::post('email'),
            'nomor_hp' => input::post('nomor_hp'),
            'level' => 'Dosen',
            'password' => input::post('password'),
            'password_confirmation' => input::post('password_confirmation')
        ]);

        try {
            $response = $this->authService->register($request);
            View::redirect('/users/register/verification?' . http_build_query([
                'id_pengguna' => $response->user->id_pengguna
            ]));
        } catch (ValidationException $e) {
            $err = $e->getErrors();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/register', [
            'error' => $err
        ]);
    }

    public function login()
    {
        $err = [];
        $request = new AuthLoginRequest([
            'email' => input::post('email'),
            'password' => input::post('password'),
        ]);

        try {
            $response = $this->authService->login($request);
            $this->sessionManagerService->create($response->user->id_pengguna, $response->user->nomor_identitas, $response->user->id_level);
            View::setFlashData('success', 'Login Success');
            View::redirect('/inventory/dashboard');
        } catch (ValidationException $e) {
            $err = $e->getErrors();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/login', [
            'error' => $err
        ]);
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
        }
    }

    public function verifyOTPForm()
    {
        View::renderPage('users/verify-otp', [
            'title' => 'Verify OTP'
        ]);
    }

    public function resendOTP()
    {
        $err = [];

        try {
            $this->authService->resendOTP(input::get('id_pengguna'));
            $response = $this->authService->getUserById(input::get('id_pengguna'));

            if ($response === null) {
                throw new Exception('Failed to create OTP.');
            }

            View::setFlashData('success', 'OTP Sent');
            View::redirect('/users/register/verification?' . http_build_query([
                'id_pengguna' => input::get('id_pengguna')
            ]));
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/verify-otp', [
            'title' => 'Verify OTP'
        ]);
    }

    public function verifyOTP()
    {
        $err = [];
        $request = new OTPVerifyRequest([
            'id_pengguna' => input::get('id_pengguna'),
            'otp' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
        ]);

        try {
            $response = $this->authService->verifyOTP($request);

            if ($response !== true) {
                throw new Exception('Failed to verify OTP.');
            }

            View::setFlashData('success', 'Register Success');
            View::redirect('/users/login');
        } catch (ValidationException $e) {
            $err = $e->getErrors();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/verify-otp', [
            'error' => $err
        ]);
    }

    public function forgotForm()
    {
        View::renderPage('users/forgot');
    }

    public function forgot()
    {
        try {
            $response = $this->authService->forgot(new AuthMailRequest([
                'email' => input::post('email')
            ]));

            if ($response === null) {
                throw new Exception('Failed to send email.');
            }

            View::setFlashData('success', 'Email Sent');
            View::redirect('/users/forgot/verification?' . http_build_query([
                'id_pengguna' => $response->user->id_pengguna
            ]));
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/forgot');
    }

    public function forgotVerifyForm()
    {
        View::renderPage('users/verify-forgot-otp', [
            'title' => 'Verify OTP'
        ]);
    }

    public function forgotVerify()
    {
        $err = [];
        $request = new OTPVerifyRequest([
            'id_pengguna' => input::get('id_pengguna'),
            'otp' => input::post('code_1') . input::post('code_2') . input::post('code_3') . input::post('code_4') . input::post('code_5') . input::post('code_6'),
        ]);

        try {
            $response = $this->authService->verifyOTP($request);

            if ($response !== true) {
                throw new Exception('Failed to verify OTP.');
            }

            View::setFlashData('success', 'OTP Verified');
            View::redirect('/users/forgot/reset?' . http_build_query([
                'id_pengguna' => input::get('id_pengguna')
            ]));
        } catch (ValidationException $e) {
            $err = $e->getErrors();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/verify-otp', [
            'error' => $err
        ]);
    }

    public function forgotResetForm()
    {
        View::renderPage('users/reset');
    }

    public function forgotReset()
    {
        $err = [];
        $request = new AuthForgotRequest([
            'id_pengguna' => input::get('id_pengguna'),
            'password' => input::post('password'),
            'password_confirmation' => input::post('password_confirmation')
        ]);

        try {
            $response = $this->authService->reset($request);

            if ($response === null) {
                throw new Exception('Failed to reset password.');
            }

            View::setFlashData('success', 'Password Reset');
            View::redirect('/users/login');
        } catch (ValidationException $e) {
            $err = $e->getErrors();
        } catch (Exception $e) {
            View::setFlashData('error', $e->getMessage());
        }

        View::renderPage('users/reset', [
            'error' => $err
        ]);
    }
}
