<?php
if (PHP_SESSION_NONE === session_status()) {
    session_start();
}

// Core
require_once __DIR__ . '/../app/App/Router.php';
require_once __DIR__ . '/../app/App/View.php';
require_once __DIR__ . '/../helpers/config.php';
require_once __DIR__ . '/../helpers/input.php';
require_once __DIR__ . '/../app/Database/Connection.php';

// Middleware
require_once __DIR__ . '/../app/Middleware/AuthOnlyMiddleware.php';
require_once __DIR__ . '/../app/Middleware/GuestOnlyMiddleware.php';
require_once __DIR__ . '/../app/Middleware/AdminOnlyMiddeware.php';
require_once __DIR__ . '/../app/Middleware/MemberOnlyMiddleware.php';

// Controllers
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/InventoryController.php';
require_once __DIR__ . '/../app/Controllers/ProfileManagementController.php';


Router::get('/admin/dashboard', [AdminController::class, 'dashboard'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);

Router::get('/admin/data-peminjaman', [AdminController::class, 'dataPeminjaman'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::get('/admin/data-peminjaman/get', [AdminController::class, 'getDetailDataPeminjaman'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::post('/admin/data-peminjaman/update', [AdminController::class, 'postUpdateDataPeminjaman'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);

Router::get('/admin/inventarisir', [AdminController::class, 'inventarisir'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::get('/admin/inventarisir/get', [AdminController::class, 'getInvertarisir'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::post('/admin/inventarisir/post', [AdminController::class, 'postCreateInventariris'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::post('/admin/inventarisir/update', [AdminController::class, 'putUpdateInventariris'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::delete('/admin/inventarisir/delete', [AdminController::class, 'deleteInventariris'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);

Router::get('/admin/riwayat-peminjaman', [AdminController::class, 'riwayat'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::get('/admin/maintainer', [AdminController::class, 'maintainer'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::get('/admin/maintainer/get', [AdminController::class, 'maintainer'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::post('/admin/maintainer/post', [AdminController::class, 'postCreateMaintainer'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::put('/admin/maintainer/update', [AdminController::class, 'putUpdateMaintainer'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);
Router::delete('/admin/maintainer/delete', [AdminController::class, 'deleteMaintainer'], [AuthOnlyMiddleware::class, AdminOnlyMiddleware::class]);


// Router Landing Page
Router::get('/', [HomeController::class, 'index'], [GuestOnlyMiddleware::class]);
// Router User Login
Router::get('/users/login', [AuthController::class, 'loginForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/login', [AuthController::class, 'login'], [GuestOnlyMiddleware::class]);
// Router User Register
Router::get('/users/register', [AuthController::class, 'registerForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/register', [AuthController::class, 'register'], [GuestOnlyMiddleware::class]);
// Router User Register Verification
Router::get('/users/register/verification', [AuthController::class, 'verifyOTPForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/register/verification', [AuthController::class, 'verifyOTP'], [GuestOnlyMiddleware::class]);
Router::get('/users/register/resend-verification', [AuthController::class, 'resendOTP'], [GuestOnlyMiddleware::class]);

// Router User Forgot Password
Router::get('/users/forgot', [AuthController::class, 'forgotForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/forgot', [AuthController::class, 'forgot'], [GuestOnlyMiddleware::class]);
// Router User Forgot Password Verification
Router::get('/users/forgot/verification', [AuthController::class, 'forgotVerifyForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/forgot/verification', [AuthController::class, 'forgotVerify'], [GuestOnlyMiddleware::class]);
Router::get('/users/forgot/resend-verification', [AuthController::class, 'forgotVerifyResend'], [GuestOnlyMiddleware::class]);
// Router User Reset Password
Router::get('/users/forgot/reset', [AuthController::class, 'forgotResetForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/forgot/reset', [AuthController::class, 'forgotReset'], [GuestOnlyMiddleware::class]);


// Router User Logout
Router::get('/users/logout', [AuthController::class, 'logout'], [AuthOnlyMiddleware::class]);


Router::get('/inventory/dashboard', [InventoryController::class, 'dashboard'], [AuthOnlyMiddleware::class, MemberOnlyMiddleware::class]);
Router::get('/inventory/historyPeminjaman', [InventoryController::class, 'historyPeminjaman']);
Router::delete('/inventory/history/delete', [InventoryController::class, 'deleteHistoryPeminjaman']);
Router::get('/inventory/dashboard', [InventoryController::class, 'dashboard']);
Router::get('/inventory/peminjaman', [InventoryController::class, 'peminjaman']);
Router::post('/inventory/peminjaman', [InventoryController::class, 'postPeminjaman']);
Router::get('/inventory/riwayat', [InventoryController::class, 'riwayat']);
Router::get('/inventory/message', [InventoryController::class, 'getListMessage']);

Router::get('/profile/profile', [ProfileManagementController::class, 'profile']);
Router::get('/profile/profile/detail', [ProfileManagementController::class, 'getProfileDetail']);
Router::post('/profile/profile/edit', [ProfileManagementController::class, 'postEditProfile']);
Router::post('/profile/profile/edit/personal', [ProfileManagementController::class, 'postEditPersonal']);
Router::post('/profile/keamanan/edit/security', [ProfileManagementController::class, 'postEditSecurity']);
Router::get('/profile/keamanan', [ProfileManagementController::class, 'security']);
Router::get('/profile/pesan', [ProfileManagementController::class, 'message']);
Router::get('/profile/hapus-akun', [ProfileManagementController::class, 'deleteAccount']);
Router::get('/profile/hapus-akun/confirm', [ProfileManagementController::class, 'deleteAccountPermament']);

date_default_timezone_set('Asia/Jakarta');

Router::run();
