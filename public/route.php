<?php


require_once __DIR__ . '/../app/App/Router.php';
require_once __DIR__ . '/../app/App/View.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/PeminjamanController.php';
require_once __DIR__ . '/../app/Controllers/RiwayatController.php';


Router::route('GET', '/', [HomeController::class, 'index']);
Router::get('/about', [HomeController::class, 'about']);
Router::get('/dashboard', [DashboardController::class, 'index']);
Router::get('/peminjaman', [PeminjamanController::class, 'index']);
Router::get('/riwayat', [RiwayatController::class, 'index']);


Router::run();
