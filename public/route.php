<?php
if (PHP_SESSION_NONE === session_status()) {
    session_start();
}

$ses = $_SESSION['session_user_id'];

// var_dump($ses);
// var_dump($_SESSION['token_' . base64_decode($ses)]);


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
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/InventoryController.php';


// Router::get('/about', [HomeController::class, 'about']);
/* Router::get('/dashboard', [DashboardController::class, 'index']);
Router::get('/peminjaman', [PeminjamanController::class, 'index']);
Router::get('/riwayat', [RiwayatController::class, 'index']); */
Router::get('/admin', [AdminController::class, 'dashboard']);

Router::get('/admin/data-peminjaman', [AdminController::class, 'dataPeminjaman']);
Router::get('/admin/data-peminjaman/get', [AdminController::class, 'getDetailDataPeminjaman']);
Router::post('/admin/data-peminjaman/update', [AdminController::class, 'postUpdateDataPeminjaman']);

Router::get('/admin/inventarisir', [AdminController::class, 'inventarisir']);
Router::get('/admin/inventarisir/get', [AdminController::class, 'getInvertarisir']);
Router::post('/admin/inventarisir/post', [AdminController::class, 'postCreateInventariris']);
Router::post('/admin/inventarisir/update', [AdminController::class, 'putUpdateInventariris']);
Router::delete('/admin/inventarisir/delete', [AdminController::class, 'deleteInventariris']);

Router::get('/admin/riwayat-peminjaman', [AdminController::class, 'riwayat']);
Router::get('/admin/maintainer', [AdminController::class, 'maintainer']);
Router::get('/admin/maintainer/get', [AdminController::class, 'maintainer']);
Router::post('/admin/maintainer/post', [AdminController::class, 'postCreateMaintainer']);
Router::put('/admin/maintainer/update', [AdminController::class, 'putUpdateMaintainer']);
Router::delete('/admin/maintainer/delete', [AdminController::class, 'deleteMaintainer']);


// Router Landing Page
Router::get('/', [HomeController::class, 'index'], [GuestOnlyMiddleware::class]);
// Router User Login
Router::get('/users/login', [AuthController::class, 'loginForm'], [GuestOnlyMiddleware::class]);
Router::post('/users/login', [AuthController::class, 'login'], [GuestOnlyMiddleware::class]);
// Router User Register
Router::get('/users/register', [AuthController::class, 'registerForm']);
Router::post('/users/register', [AuthController::class, 'register']);
// Router User Register Verification
Router::get('/users/register/verification', [AuthController::class, 'verifyOTPForm']);
Router::post('/users/register/verification', [AuthController::class, 'verifyOTP']);
Router::get('/users/register/resend-verification', [AuthController::class, 'resendOTP']);

// Router User Forgot Password
Router::get('/users/forgot', [AuthController::class, 'forgotForm']);
Router::post('/users/forgot', [AuthController::class, 'forgot']);
// Router User Forgot Password Verification
Router::get('/users/forgot/verification', [AuthController::class, 'forgotVerifyForm']);
Router::post('/users/forgot/verification', [AuthController::class, 'forgotVerify']);
Router::get('/users/forgot/resend-verification', [AuthController::class, 'forgotVerifyResend']);
// Router User Reset Password
Router::get('/users/forgot/reset', [AuthController::class, 'forgotResetForm']);
Router::post('/users/forgot/reset', [AuthController::class, 'forgotReset']);


// Router User Logout
Router::get('/users/logout', [AuthController::class, 'logout'], [AuthOnlyMiddleware::class]);


Router::get('/inventory/dashboard', [InventoryController::class, 'dashboard']);
Router::get('/inventory/historyPeminjaman', [InventoryController::class, 'historyPeminjaman']);
Router::delete('/inventory/history/delete', [InventoryController::class, 'deleteHistoryPeminjaman']);
Router::get('/inventory/dashboard', [InventoryController::class, 'dashboard']);
Router::get('/inventory/peminjaman', [InventoryController::class, 'peminjaman']);
Router::get('/inventory/riwayat', [InventoryController::class, 'riwayat']);


Router::get('/profile/profil', [InventoryController::class, 'profil']);
Router::get('/profile/keamanan', [InventoryController::class, 'keamanan']);
Router::get('/profile/pesan', [InventoryController::class, 'pesan']);
Router::get('/profile/hapus-akun', [InventoryController::class, 'hapusAkun']);



// require_once __DIR__ . '/../app/Repository/MaintainerInventarisRepository.php';
// require_once __DIR__ . '/../app/Services/PeminjamanService.php';

// var_dump((new PeminjamanService)->searchDataPeminjaman(''));

// var_dump((new InventarisirService)->search('obe'));

// // $maintainer = new MaintainerRepository();
// // $main = new Maintainer();
// // $main->ID_Maintainer = 'M5';
// // $main->Nama = 'Eko';
// // var_dump($maintainer->search(''));
// // var_dump($maintainer->search('Pa'));

Router::run();
