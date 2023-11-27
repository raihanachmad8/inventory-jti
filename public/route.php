<?php


require_once __DIR__ . '/../app/App/Router.php';
require_once __DIR__ . '/../app/App/View.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';


Router::route('GET','/', [HomeController::class, 'index']);
Router::get('/about', [HomeController::class, 'about']);


Router::run();
