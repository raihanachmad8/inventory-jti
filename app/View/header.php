<?php

$current_page_url = $_SERVER['REQUEST_URI'];

$menu_items = [
    'admin' => '/admin/dashboard',
    'admin/data-peminjaman' => '/admin/data-peminjaman',
    'admin/inventarisir' => '/admin/inventarisir',
    'admin/riwayat-peminjaman' => '/admin/riwayat-peminjaman',
    'admin/maintainer' => '/admin/maintainer',
    'dashboard' => '/inventory/dashboard',
    'peminjaman' => '/inventory/peminjaman',
    'riwayat' => '/inventory/riwayat',
    'profil' => '/profile/profile',
    'keamanan' => '/profile/keamanan',
    'pesan' => '/profile/pesan',
    'hapus-akun' => '/profile/hapus-akun',
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body style="background-color: #ececec">
    <div id="content" class="d-flex vw-100">
        <!-- Side Bar -->
        <div class="sidebar duration-300 d-flex flex-column gap-5 bg-white container-fluid py-4 vh-100 d-none d-lg-flex">
            <div class="gap-2" style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; ">
                <div class="d-flex gap-2 sidebar-decoration d-none align-items-center ">
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #0a60a4"></div>
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #ffa500"></div>
                    <div class="rounded-circle" style="width: 1.5rem; height: 1.5rem; background-color: #e3f2f9"></div>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button name="sidebar-btn" class="btn sidebar-btn duration-300 text-white sidebar-btn-rotate" style="background-color: #01305d; cursor: pointer">
                        <i data-feather="chevrons-left"></i>
                    </button>
                </div>
            </div>
            <div class="logo-container duration-300 hidden">
                <div class="logo-container-inner" style="<?= ($model['pengguna']->Level->Nama_Level) === 'Admin' ? 'width: 23rem' : 'width: 14rem' ?> height: fit-content;">
                    <img src="<?= ($model['pengguna']->Level->Nama_Level) == 'Admin' ? '/public/assets/images/logo-polinema-admin.svg' : '/public/assets/images/polinema-logo.png' ?>" alt="" class="object-fit-cover ratio-16x9 w-100" />
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="d-flex justify-content-center align-items-center  flex-column row-gap-4" style="list-style: none; padding: 0">
                    <li class="nav-menu-container d-flex justify-content-center p-2 rounded-2 <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'background-color: #01305d;' : '' ?> width: fit-content">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/dashboard' : '/admin/dashboard' ?>" class="nav-menu-icon text-decoration-none <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'text-white' : 'text-dark' ?>" style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; width: fit-content;">
                            <i data-feather="grid" class="menu-icon"></i>
                            <p class="text-menu d-none">
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-menu-container d-flex justify-content-center p-2 rounded-2 <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'background-color: #01305d;' : '' ?> width: fit-content">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/peminjaman' : '/admin/data-peminjaman' ?>" class=" nav-menu-icon text-decoration-none <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; width: fit-content;">
                            <i data-feather="shopping-cart" class="menu-icon"></i>
                            <p class="text-menu d-none">
                                <?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? 'Peminjaman' : 'Data Peminjaman' ?></p>
                        </a>
                    </li>
                    <li class="nav-menu-container d-flex justify-content-center p-2 rounded-2 <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'background-color: #01305d;' : '' ?> width: fit-content">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/riwayat' : '/admin/inventarisir' ?>" class="nav-menu-icon d-flex justify-content-start align-items-center text-decoration-none <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'text-white' : 'text-dark' ?> " style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; width: fit-content;">
                            <?php if (($model['pengguna']->Level->Nama_Level) === 'Admin') : ?>
                                <i data-feather="archive" class="menu-icon"></i>
                            <?php else : ?>
                                <i data-feather="clock"></i>
                            <?php endif; ?><p class="text-menu d-none"><?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? 'Riwayat' : 'Inventarisir' ?></p></a>
                    </li>
                    <li class="nav-menu-container d-flex justify-content-center p-2 rounded-2 <?= ($model['pengguna']->Level->Nama_Level) === 'Admin' ? 'd-block' : 'd-none' ?> <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'background-color: #01305d;' : '' ?> width: fit-content">
                        <a href="/admin/riwayat-peminjaman" class="nav-menu-icon d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; width: fit-content;">
                            <i data-feather="clock" class="menu-icon"></i>
                            <p class="text-menu d-none">
                                Riwayat Peminjaman
                            </p>
                        </a>
                    </li>
                    <li class="nav-menu-container d-flex justify-content-center p-2 rounded-2 <?= ($model['pengguna']->Level->Nama_Level) === 'Admin' ? 'd-block' : 'd-none' ?> <?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'background-color: #01305d;' : '' ?> width: fit-content">
                        <a href="/admin/maintainer" class="nav-menu-icon d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'text-white' : 'text-dark' ?>" style="display: grid; grid-template-columns: auto auto; justify-content: between; align-content: center; width: fit-content;">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="<?= active_page($current_page_url, $menu_items['admin/maintainer']) ? '#fff' : '#000' ?>" d="m8,12c3.309,0,6-2.691,6-6S11.309,0,8,0,2,2.691,2,6s2.691,6,6,6Zm0-10c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4Zm.992,12.938c.068.548-.32,1.047-.869,1.116-3.491.436-6.124,3.421-6.124,6.946,0,.552-.448,1-1,1s-1-.448-1-1c0-4.531,3.386-8.37,7.876-8.93.542-.069,1.047.32,1.116.869Zm13.704,4.195l-.974-.562c.166-.497.278-1.019.278-1.572s-.111-1.075-.278-1.572l.974-.562c.478-.276.642-.888.366-1.366-.277-.479-.888-.643-1.366-.366l-.973.562c-.705-.794-1.644-1.375-2.723-1.594v-1.101c0-.552-.448-1-1-1s-1,.448-1,1v1.101c-1.079.22-2.018.801-2.723,1.594l-.973-.562c-.481-.277-1.09-.113-1.366.366-.276.479-.112,1.09.366,1.366l.974.562c-.166.497-.278,1.019-.278,1.572s.111,1.075.278,1.572l-.974.562c-.478.276-.642.888-.366,1.366.186.321.521.5.867.5.169,0,.341-.043.499-.134l.973-.562c.705.794,1.644,1.375,2.723,1.594v1.101c0,.552.448,1,1,1s1-.448,1-1v-1.101c1.079-.22,2.018-.801,2.723-1.594l.973.562c.158.091.33.134.499.134.346,0,.682-.179.867-.5.276-.479.112-1.09-.366-1.366Zm-5.696.866c-1.654,0-3-1.346-3-3s1.346-3,3-3,3,1.346,3,3-1.346,3-3,3Z" />
                            </svg>
                            <p class="text-menu d-none">
                                Maintainer
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="menu duration-300 d-lg-none position-fixed end-0 top-0 vw-100 vh-100 z-3">
            <div class="w-75 h-100 bg-white" style="padding: 7rem 1.5rem 0 1.5rem;">
                <ul class="d-flex flex-column row-gap-4" style="list-style: none; padding: 0">
                    <li class="d-flex gap-3 p-3 rounded-2 <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'background-color: #01305d' : '' ?>">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/dashboard' : '/admin' ?>" class=" d-flex justify-content-start align-items-center w-100  text-decoration-none d-flex gap-3 <?= active_page($current_page_url, $menu_items['dashboard']) || active_page($current_page_url, $menu_items['admin']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="grid" class="menu-icon"></i>
                            <p class="text-menu">
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="d-flex gap-3  p-3  rounded-2 <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'background-color: #01305d' : '' ?>">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/peminjaman' : '/admin/data-peminjaman' ?>" class="d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3 <?= active_page($current_page_url, $menu_items['peminjaman']) || active_page($current_page_url, $menu_items['admin/data-peminjaman']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="shopping-cart" class="menu-icon"></i>
                            <p class="text-menu">
                                <?= ($model['pengguna']->Level->Nama_Level) == 'Admin' ? 'Peminjaman' : 'Data Peminjaman' ?></p>
                        </a>
                    </li>
                    <li class="d-flex gap-3  p-3  rounded-2 <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'background-color: #01305d' : '' ?>">
                        <a href="<?= ($model['pengguna']->Level->Nama_Level) !== 'Admin' ? '/inventory/riwayat' : '/admin/inventarisir' ?>" class="d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['riwayat']) || active_page($current_page_url, $menu_items['admin/inventarisir']) ? 'text-white' : 'text-dark' ?>">
                            <?php if (($model['pengguna']->Level->Nama_Level) === 'admin') : ?>
                                <i data-feather="archive" class="menu-icon"></i>
                            <?php else : ?>
                                <i data-feather="clock"></i>
                            <?php endif; ?><p class="text-menu"><?= ($model['pengguna']->Level->Nama_Level) !==  'Admin' ? 'Riwayat' : 'Inventarisir' ?></p></a>
                    </li>
                    <li class="d-flex gap-3  p-3  rounded-2 <?= ($model['pengguna']->Level->Nama_Level) === 'admin' ? 'd-block' : 'd-none' ?> <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'background-color: #01305d' : '' ?>">
                        <a href="/admin/riwayat-peminjaman" class="d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['admin/riwayat-peminjaman']) ? 'text-white' : 'text-dark' ?>">
                            <i data-feather="clock" class="menu-icon"></i>
                            <p class="text-menu">
                                Riwayat Peminjaman
                            </p>
                        </a>
                    </li>
                    <li class="d-flex gap-3  p-3  rounded-2 <?= ($model['pengguna']->Level->Nama_Level) === 'Admin' ? 'd-block' : 'd-none' ?> <?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'text-white' : 'text-dark' ?>" style="<?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'background-color: #01305d' : '' ?>">
                        <a href="/admin/maintainer" class="d-flex justify-content-start align-items-center w-100 text-decoration-none d-flex gap-3  <?= active_page($current_page_url, $menu_items['admin/maintainer']) ? 'text-white' : 'text-dark' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="<?= active_page($current_page_url, $menu_items['admin/maintainer']) ? '#fff' : '#000' ?>" d="m8,12c3.309,0,6-2.691,6-6S11.309,0,8,0,2,2.691,2,6s2.691,6,6,6Zm0-10c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4Zm.992,12.938c.068.548-.32,1.047-.869,1.116-3.491.436-6.124,3.421-6.124,6.946,0,.552-.448,1-1,1s-1-.448-1-1c0-4.531,3.386-8.37,7.876-8.93.542-.069,1.047.32,1.116.869Zm13.704,4.195l-.974-.562c.166-.497.278-1.019.278-1.572s-.111-1.075-.278-1.572l.974-.562c.478-.276.642-.888.366-1.366-.277-.479-.888-.643-1.366-.366l-.973.562c-.705-.794-1.644-1.375-2.723-1.594v-1.101c0-.552-.448-1-1-1s-1,.448-1,1v1.101c-1.079.22-2.018.801-2.723,1.594l-.973-.562c-.481-.277-1.09-.113-1.366.366-.276.479-.112,1.09.366,1.366l.974.562c-.166.497-.278,1.019-.278,1.572s.111,1.075.278,1.572l-.974.562c-.478.276-.642.888-.366,1.366.186.321.521.5.867.5.169,0,.341-.043.499-.134l.973-.562c.705.794,1.644,1.375,2.723,1.594v1.101c0,.552.448,1,1,1s1-.448,1-1v-1.101c1.079-.22,2.018-.801,2.723-1.594l.973.562c.158.091.33.134.499.134.346,0,.682-.179.867-.5.276-.479.112-1.09-.366-1.366Zm-5.696.866c-1.654,0-3-1.346-3-3s1.346-3,3-3,3,1.346,3,3-1.346,3-3,3Z" />
                            </svg>
                            <p class="text-menu">
                                Maintainer
                            </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <main class="main-container duration-300 d-flex flex-column position-relative ">
            <!-- Header -->
            <header class="d-flex bg-white py-3 px-4 justify-content-between duration-300 z-3">
                <div class="header-logo">
                    <img src="/public/assets/images/logo-tulisan.svg" alt="" class="w-100 object-fit-cover ratio-16x9" />
                </div>
                <div class="d-flex justify-content-center align-items-center gap-2 gap-md-3 ">
                    <?=  $model['pengguna']->Nama_Pengguna  ?>
                    <!-- Profile -->
                    <button aria-label="button-profile" type="button" class="button-profile btn d-flex justify-content-center align-items-center gap-2 rounded-5 p-2 position-relative ">
                        <div style="width: 3rem; height: 3rem" class="rounded-circle position-relative ">
                            <div class="position-absolute -top-0 end-0 bg-success rounded-circle" style="width: 1rem; height: 1rem"></div>
                            <div class="rounded-circle overflow-hidden w-100 h-100">
                                <img src="/public/assets/images/profile/<?= !empty($model['pengguna']->Foto) ? $model['pengguna']->Foto : 'default.jpeg' ?>" style="width: 3rem; height: 3rem; border-radius: 50%; object-fit: contain; background-repeat: no-repeat; object-position: center;" alt="default-profile">
                            </div>
                        </div>
                        <div class="profile-menu position-absolute bg-white end-0 rounded-4 p-3 border border-light d-none z-100 " style="width: 9rem; bottom: -6rem; opacity: 0;">
                            <ul class="d-flex flex-column row-gap-2">
                                <li><a href="/profile/profile" class="nav-link text-start" style="color: #01305d;">Profile</a></li>
                                <li><a href="/users/logout" class="text-danger nav-link text-start ">Logout <i data-feather="log-out"></i> </a></li>
                            </ul>
                        </div>
                    </button>

                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="30" height="30" class="hamburger-menu d-lg-none">
                        <rect y="11" width="30" height="2" rx="1" class="line-1 duration-300" />
                        <rect y="16" width="30" height="2" rx="1" class="line-2 duration-300" />
                    </svg>
                </div>
            </header>
