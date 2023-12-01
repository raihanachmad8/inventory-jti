<?php
$current_page_url = $_SERVER['REQUEST_URI'];



$menu_items = [
    'admin' => '/admin',
    'admin/data-peminjaman' => '/admin/data-peminjaman',
    'admin/inventarisir' => '/admin/inventarisir',
    'admin/riwayat-peminjaman' => '/admin/riwayat-peminjaman',
    'dashboard' => '/dashboard',
    'peminjaman' => '/peminjaman',
    'riwayat' => '/riwayat',
];

function active_page($current_page, $target)
{
    return $current_page === $target;
}

function user_role()
{
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    $path = explode('/', trim($parsed_url['path'], '/'));
    return in_array('admin', $path) ? 'admin' : 'user';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peminjaman</title>
    <link rel="stylesheet" href="/public/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body style="background-color: #ececec">
    <div class="d-flex vw-100 h-auto">
        <!-- Side Bar -->
        <div class="sidebar duration-300 d-flex flex-column gap-5 bg-white container-fluid p-4 vh-100 d-none d-xl-flex">
            <div class="d-flex gap-2 justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #0a60a4"></div>
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #ffa500"></div>
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #e3f2f9"></div>
                </div>
                <button class="btn sidebar-btn" style="cursor: pointer">
                    <i data-feather="chevrons-right"></i>
                </button>
            </div>
            <div class="logo-container duration-500">
                <div class="logo-container-inner" style="<?= user_role() === 'admin' ? 'width: 23rem' : 'width: 14rem' ?> height: fit-content;">
                    <img src="<?= user_role() == 'admin' ? '/public/assets/images/logo-polinema-admin.svg' : '/public/assets/images/polinema-logo.png' ?>" alt="" class="object-fit-cover ratio-16x9 w-100" />
                </div>
            </div>
            <div>
                <ul class="d-flex flex-column row-gap-4" style="list-style: none; padding: 0">
                    <li class="d-flex gap-3  p-2 rounded-2 <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'bg-primary text-white' : 'text-dark' ?>">
                        <a href="<?= user_role() == 'user' ? '/dashboard' : '/admin' ?>" class="text-menu text-decoration-none d-flex gap-3 <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="grid"></i>
                            Dashboard</a>
                    </li>
                    <li class="d-flex gap-3  p-2 rounded-2 <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'bg-primary text-white' : 'text-dark' ?>">
                        <a href="<?= user_role() == 'user' ? '/peminjaman' : '/admin/data-peminjaman' ?>" class="text-menu text-decoration-none d-flex gap-3 <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="shopping-cart"></i>
                            <?= user_role() == 'user' ? 'Peminjaman' : 'Data Peminjaman' ?></a>
                    </li>
                    <li class="d-flex gap-3  p-2 rounded-2 <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'bg-primary text-white' : 'text-dark' ?>">
                        <a href="<?= user_role() == 'user' ? '/riwayat' : '/admin/inventarisir' ?>" class="text-menu text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'text-white' : 'text-dark' ?>">
                            <?php if (user_role() === 'admin') : ?>
                                <i data-feather="archive"></i>
                            <?php else : ?>
                                <i data-feather="clock"></i>
                                <?php endif; ?><?= user_role() == 'user' ? 'Riwayat' : 'Inventarisir' ?></a>
                    </li>
                    <li class="d-flex gap-3  p-2 rounded-2 <?= user_role() == 'admin' ? 'd-block' : 'd-none' ?> <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) || active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'bg-primary text-white' : 'text-dark' ?>">
                        <a href="/admin/riwayat-peminjaman" class="text-menu text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="clock"></i>
                            Riwayat Peminjaman</a>
                    </li>
                </ul>
            </div>
        </div>
        <main class="container-fluid main-container duration-300 h-auto d-flex flex-column justify-content-between vh-100">

            <!-- Header -->
            <header class="d-flex bg-white p-3 justify-content-between duration-300 z-3">
                <div class="header-logo">
                    <img src="/public/assets/images/logo-tulisan.png" alt="" class="w-100 object-fit-cover ratio-16x9" />
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <div>
                        <i data-feather="search"></i>
                    </div>
                    <div class="d-none d-xl-block">
                        <i data-feather="mail"></i>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="30" height="30" class="hamburger-menu d-xl-none">
                        <rect y="11" width="30" height="2" rx="1" class="line-1 duration-300" />
                        <rect y="16" width="30" height="2" rx="1" class="line-2 duration-300" />
                    </svg>

                    <!-- Profile -->
                    <div class="d-flex justify-content-center align-items-center gap-2 rounded-5 p-2 d-none d-xl-flex">
                        <div style="width: 3rem; height: 3rem" class="rounded-circle position-relative ">
                            <div class="position-absolute -top-0 end-0 bg-success rounded-circle" style="width: 1rem; height: 1rem"></div>
                            <div class="rounded-circle overflow-hidden w-100 h-100">
                                <img src="https://source.unsplash.com/random/900×700/?potrait" alt="" class="object-fit-cover ratio-1x1 w-100 h-100" />
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-between">
                            <strong class="name" style="font-size: 0.7rem">Putra Z.M</strong>
                            <p class="m-0 text-body-tertiary" style="font-size: 0.7rem">Student</p>
                        </div>
                    </div>
                </div>
            </header>