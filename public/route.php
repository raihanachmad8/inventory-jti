<?php
// Core
require_once __DIR__ . '/../app/App/Router.php';
require_once __DIR__ . '/../app/App/View.php';
require_once __DIR__ . '/../helpers/config.php';
require_once __DIR__ . '/../helpers/input.php';
require_once __DIR__ . '/../app/Database/Connection.php';

// Middleware
require_once __DIR__ . '/../app/Middleware/AuthOnlyMiddleware.php';
require_once __DIR__ . '/../app/Middleware/GuestOnlyMiddleware.php';

// Controllers
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/PeminjamanController.php';
require_once __DIR__ . '/../app/Controllers/RiwayatController.php';
require_once __DIR__ . '/../app/Controllers/DashboardAdminController.php';
require_once __DIR__ . '/../app/Controllers/DataPeminjamanAdminController.php';
require_once __DIR__ . '/../app/Controllers/InventarisirController.php';
require_once __DIR__ . '/../app/Controllers/RiwayatPeminjamanController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';


Router::get('/dashboard', [DashboardController::class, 'index']);
Router::get('/peminjaman', [PeminjamanController::class, 'index']);
Router::get('/riwayat', [RiwayatController::class, 'index']);
Router::get('/admin', [DashboardAdminController::class, 'index']);
Router::get('/admin/data-peminjaman', [DataPeminjamanAdminController::class, 'index']);
Router::get('/admin/inventarisir', [InventarisirController::class, 'index']);
Router::get('/admin/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index']);


// Router Landing Page
Router::get('/', [HomeController::class, 'index'], [GuestOnlyMiddleware::class]);
// Router User Login
Router::get('/users/login', [UserController::class, 'loginForm']);
Router::post('/users/login', [UserController::class, 'login']);
// Router User Register
Router::get('/users/register', [UserController::class, 'registerForm']);
Router::post('/users/register', [UserController::class, 'register']);
// Router User Register Verification
Router::get('/users/register/verification', [UserController::class, 'verifyOTPForm']);
Router::post('/users/register/verification', [UserController::class, 'verifyOTP']);
Router::get('/users/register/resend-verification', [UserController::class, 'resendOTP']);

// Router User Forgot Password
Router::get('/users/forgot', [UserController::class, 'forgotForm']);
Router::post('/users/forgot', [UserController::class, 'forgot']);
// Router User Forgot Password Verification
Router::get('/users/forgot/verification', [UserController::class, 'forgotVerifyForm']);
Router::post('/users/forgot/verification', [UserController::class, 'forgotVerify']);
Router::get('/users/forgot/resend-verification', [UserController::class, 'forgotVerifyResend']);
// Router User Reset Password
Router::get('/users/forgot/reset', [UserController::class, 'forgotResetForm']);
Router::post('/users/forgot/reset', [UserController::class, 'forgotReset']);


// Router User Logout
Router::get('/users/logout', [UserController::class, 'logout'], [AuthOnlyMiddleware::class]);


Router::get('/inventory/dashboard', [InventoryController::class, 'dashboard'], [AuthOnlyMiddleware::class]);


Router::run();
