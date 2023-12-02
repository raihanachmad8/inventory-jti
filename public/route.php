<?php


require_once __DIR__ . '/../app/App/Router.php';
require_once __DIR__ . '/../app/App/View.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';


Router::route('GET', '/', [HomeController::class, 'index']);
Router::get('/about', [HomeController::class, 'about']);
Router::get('/dashboard', [UserController::class, 'dashboard']);
Router::get('/peminjaman', [UserController::class, 'peminjaman']);
Router::get('/riwayat', [UserController::class, 'riwayat']);
Router::get('/admin', [AdminController::class, 'dashboard']);
Router::get('/admin/data-peminjaman', [AdminController::class, 'dataPeminjaman']);
Router::get('/admin/inventarisir', [AdminController::class, 'inventarisir']);
Router::get('/admin/riwayat-peminjaman', [AdminController::class, 'riwayat']);

Router::run();
