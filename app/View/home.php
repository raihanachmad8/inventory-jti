<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>INTI | Inventari Jurusan Teknologi Informasi</title>
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
    <!-- Navbar -->

    <nav class="nav fixed-top vw-100" style="z-index: 9999; background-color: rgba(0,0,0,0.8);">
        <div class="container-fluid d-flex justify-content-between">
            <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" alt="Logo" width="70" height="70" />

            <button class="p-2 btn hamburger-nav d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="30" height="30">
                    <rect fill="#fff" y="11" width="24" height="2" rx="1" />
                    <rect fill="#fff" y="4" width="24" height="2" rx="1" />
                    <rect fill="#fff" y="18" width="24" height="2" rx="1" />
                </svg>
            </button>

            <div class="d-none d-md-block">
                <ul class="d-flex justify-content-center align-items-center h-100 text-white ">
                    <li>
                        <a class="nav-link text-white " href="#home">Home</a>
                    </li>
                    <li>
                        <a class="nav-link text-white " href="#about">About</a>
                    </li>
                    <li>
                        <a class="nav-link text-white " href="#feature">Feature</a>
                    </li>
                    <li>
                        <a class="nav-link text-white " href="#team">Team</a>
                    </li>
                    <li>
                        <a class="nav-link text-white " href="#faq">FAQ</a>
                    </li>
                    <li>
                        <a class="nav-link text-white " href="#footer">Contact</a>
                    </li>
                </ul>
            </div>

            <a href="/users/login" class="d-none d-md-flex justify-content-center align-items-center ">
                <button type="button" class="btn btn-primary">
                    Sign In
                </button>
            </a>
        </div>
    </nav>

    <div class="d-md-none nav-menu position-fixed end-0 top-0 bg-white vw-100 vh-100 " style="z-index: 99; padding-top: 10rem;">
        <ul class="d-flex flex-column row-gap-4 ">
            <li>
                <a class="nav-link" href="#home" style="font-size: 1.5rem;">Home</a>
            </li>
            <li>
                <a class="nav-link" href="#about" style="font-size: 1.5rem;">About</a>
            </li>
            <li>
                <a class="nav-link" href="#feature" style="font-size: 1.5rem;">Feature</a>
            </li>
            <li>
                <a class="nav-link" href="#team" style="font-size: 1.5rem;">Team</a>
            </li>
            <li>
                <a class="nav-link" href="#faq" style="font-size: 1.5rem;">FAQ</a>
            </li>
            <li>
                <a class="nav-link" href="#footer" style="font-size: 1.5rem;">Contact</a>
            </li>
            <li>
                <button class="btn btn-primary" style="font-size: 1.5rem;">Sign In</button>
            </li>
        </ul>
    </div>

    <!-- Gambar -->
    <div id="home" class="mx-auto image-container vh-100 overflow-hidden">
        <img src="/public/assets/images/hero.svg" alt="Gambar" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover" />
        <div class="text-over-image">
            <h1>Selamat Datang di Website Inventaris JTI POLINEMA !</h1>
            <p>
                Inventaris adalah daftar atau catatan rinci yang mencakup
                semua barang, <br />
                aset, atau benda yang dimiliki, disimpan, atau digunakan
                oleh suatu
                <br />
                organisasi, perusahaan, atau individu pada suatu waktu
                tertentu.
            </p>
        </div>
    </div>

    <!-- Teks -->
    <div id="about" class="container-fluid d-flex flex-column justify-content-center align-items-center py-5" style="background-color: #02357029;">
        <div class="mb-5"></div>
        <img class="mb-1" src="/public/assets/images/quote.svg" />
        <h1 class="display-5 mb-3" style="color: #074a81; font-weight: 700;">
            Tentang
        </h1>
        <p class="lead text-center">
            Sebuah proyek dibuat untuk
            memberikan kemudahan dalam pengelolaan dan peminjaman peralatan
            di lingkungan Jurusan Teknologi Informasi Politeknik Negeri
            Malang. Melalui inovasi ini, kami bertujuan untuk meningkatkan
            efisiensi serta mempermudah mahasiswa dan staf jurusan Teknologi
            Informasi dalam mendapatkan akses dan informasi terkait
            peminjaman barang. <br /><br />
            Dengan antarmuka yang ramah pengguna, Anda dapat dengan mudah
            menjelajahi katalog barang yang tersedia, melakukan peminjaman,
            dan mengelola status peminjaman Anda. Kami berkomitmen untuk
            menyediakan layanan yang dapat mendukung kegiatan akademis dan
            proyek-proyek kreatif Anda.
        </p>
        <div class="lead text-center">
            <p class="text-center mb-3">
                Peminjaman Menjadi Lebih Mudah dengan kemudahan proses dan persyaratan yang sederhana,
                pengajuan pinjaman kini menjadi langkah yang lebih mudah dan cepat, tanpa kerumitan yang
                berlebihan.
            </p>
            <a href="../login/">
                <button type="button" class="mb-5 btn btn-primary">
                    Sign Up Now
                </button>
            </a>
        </div>
    </div>

    <!-- Card Feature-->
    <div id="feature" class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <div class="mb-5"></div>
        <h1 class="text-center display-5 mb-5" style="color: #074a81; font-weight: 700;">Fitur Kami</h1>
        <div class="feature-container rounded column-gap-3">
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-peminjaman-landing.svg" />
                    <h5 class="card-title">Peminjaman</h5>
                    <p class="card-text text-justify">
                        Pengguna meminjam barang atau item dari platform.
                    </p>
                </div>
            </div>
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-batalpeminjaman.svg" />
                    <h5 class="card-title">Batalkan Peminjaman</h5>
                    <p class="card-text text-justify">
                        Pengguna membatalkan permintaan atau peminjaman
                        barang yang telah diajukan sebelumnya.
                    </p>
                </div>
            </div>
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-profile-pengguna.svg" />
                    <h5 class="card-title">Profile Pengguna</h5>
                    <p class="card-text text-justify">
                        Pengguna mengelola informasi pribadi mereka dan
                        menyesuaikan preferensi di dalam platform.
                    </p>
                </div>
            </div>
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-history.svg" />
                    <h5 class="card-title">History</h5>
                    <p class="card-text text-justify">
                        Menyimpan catatan atau sejarah aktivitas pengguna,
                        seperti peminjaman, pembatalan, atau perubahan data.
                    </p>
                </div>
            </div>
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-tambahbarang.svg" />
                    <h5 class="card-title">Tambah Barang</h5>
                    <p class="card-text text-justify">
                        Fitur ini memungkinkan Admin untuk menambahkan item
                        atau barang baru ke dalam sistem atau platform.
                    </p>
                </div>
            </div>
            <div class="card mb-3 w-100" style="height: 18rem">
                <div class="card-body">
                    <img src="/public/assets/images/icon-hapusbarang.svg" />
                    <h5 class="card-title">Hapus Barang</h5>
                    <p class="card-text text-justify">
                        Fitur ini memungkinkan Admin untuk menghapus item
                        atau barang dari sistem atau platform.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team -->
    <div id="team" class="container-fluid d-flex justify-content-center align-items-center d-flex flex-column">
        <div class="mb-5"></div>
        <h1 class="text-center display-5 mb-5" style="color: #074a81; font-weight: 700;">The creative team behind the door</h1>
        <div class="team-container mx-auto">
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100;">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100;">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 h-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 h-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 h-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 h-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 d-flex bg-body-tertiary p-3 rounded-4" style="background-color: #074a8100">
                <div class="text-center d-flex justify-content-center align-items-center w-50">
                    <img src="/public/assets/images/user-icon.svg" class="" class="w-100 h-100" />
                </div>
                <div class=" d-flex flex-column ">
                    <div class="w-100 h-100 ">
                        <h5 class="fw-bold ">Putra Zakaria Muzaki</h5>
                        <p>Habis gelap terbitlah tidur</p>
                        <p>Project Manager</p>
                    </div>
                    <div class="w-100 h-100 d-flex flex-column  justify-content-end ">
                        <div class="py-3 d-flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.308,0.06,2.655,0.358,3.608,1.311c0.962,0.962,1.251,2.296,1.311,3.608   c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.059,1.301-0.364,2.661-1.311,3.608   c-0.962,0.962-2.295,1.251-3.608,1.311c-1.265,0.058-1.645,0.07-4.849,0.07s-3.584-0.012-4.849-0.07   c-1.291-0.059-2.669-0.371-3.608-1.311c-0.957-0.957-1.251-2.304-1.311-3.608c-0.058-1.265-0.07-1.645-0.07-4.849   c0-3.204,0.012-3.584,0.07-4.849c0.059-1.296,0.367-2.664,1.311-3.608c0.96-0.96,2.299-1.251,3.608-1.311   C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C5.197,0.157,3.355,0.673,2.014,2.014   C0.668,3.36,0.157,5.198,0.072,7.052C0.014,8.332,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.085,1.853,0.603,3.7,1.942,5.038   c1.345,1.345,3.186,1.857,5.038,1.942C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072   c1.854-0.085,3.698-0.602,5.038-1.942c1.347-1.347,1.857-3.184,1.942-5.038C23.986,15.668,24,15.259,24,12   c0-3.259-0.014-3.668-0.072-4.948c-0.085-1.855-0.602-3.698-1.942-5.038c-1.343-1.343-3.189-1.858-5.038-1.942   C15.668,0.014,15.259,0,12,0z" />
                                    <path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162   C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z" />
                                    <circle cx="18.406" cy="5.594" r="1.44" />
                                </g>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 24 24" width="20" height="20">
                                <path d="m18.9,1.153h3.682l-8.042,9.189,9.46,12.506h-7.405l-5.804-7.583-6.634,7.583H.469l8.6-9.831L0,1.153h7.593l5.241,6.931,6.065-6.931Zm-1.293,19.494h2.039L6.482,3.239h-2.19l13.314,17.408Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" width="20" height="20">
                                <g>
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M12,0.296c-6.627,0-12,5.372-12,12c0,5.302,3.438,9.8,8.206,11.387   c0.6,0.111,0.82-0.26,0.82-0.577c0-0.286-0.011-1.231-0.016-2.234c-3.338,0.726-4.043-1.416-4.043-1.416   C4.421,18.069,3.635,17.7,3.635,17.7c-1.089-0.745,0.082-0.729,0.082-0.729c1.205,0.085,1.839,1.237,1.839,1.237   c1.07,1.834,2.807,1.304,3.492,0.997C9.156,18.429,9.467,17.9,9.81,17.6c-2.665-0.303-5.467-1.332-5.467-5.93   c0-1.31,0.469-2.381,1.237-3.221C5.455,8.146,5.044,6.926,5.696,5.273c0,0,1.008-0.322,3.301,1.23   C9.954,6.237,10.98,6.104,12,6.099c1.02,0.005,2.047,0.138,3.006,0.404c2.29-1.553,3.297-1.23,3.297-1.23   c0.653,1.653,0.242,2.873,0.118,3.176c0.769,0.84,1.235,1.911,1.235,3.221c0,4.609-2.807,5.624-5.479,5.921   c0.43,0.372,0.814,1.103,0.814,2.222c0,1.606-0.014,2.898-0.014,3.293c0,0.319,0.216,0.694,0.824,0.576   c4.766-1.589,8.2-6.085,8.2-11.385C24,5.669,18.627,0.296,12,0.296z" />
                                    <path d="M4.545,17.526c-0.026,0.06-0.12,0.078-0.206,0.037c-0.087-0.039-0.136-0.121-0.108-0.18   c0.026-0.061,0.12-0.078,0.207-0.037C4.525,17.384,4.575,17.466,4.545,17.526L4.545,17.526z" />
                                    <path d="M5.031,18.068c-0.057,0.053-0.169,0.028-0.245-0.055c-0.079-0.084-0.093-0.196-0.035-0.249   c0.059-0.053,0.167-0.028,0.246,0.056C5.076,17.903,5.091,18.014,5.031,18.068L5.031,18.068z" />
                                    <path d="M5.504,18.759c-0.074,0.051-0.194,0.003-0.268-0.103c-0.074-0.107-0.074-0.235,0.002-0.286   c0.074-0.051,0.193-0.005,0.268,0.101C5.579,18.579,5.579,18.707,5.504,18.759L5.504,18.759z" />
                                    <path d="M6.152,19.427c-0.066,0.073-0.206,0.053-0.308-0.046c-0.105-0.097-0.134-0.234-0.068-0.307   c0.067-0.073,0.208-0.052,0.311,0.046C6.191,19.217,6.222,19.355,6.152,19.427L6.152,19.427z" />
                                    <path d="M7.047,19.814c-0.029,0.094-0.164,0.137-0.3,0.097C6.611,19.87,6.522,19.76,6.55,19.665   c0.028-0.095,0.164-0.139,0.301-0.096C6.986,19.609,7.075,19.719,7.047,19.814L7.047,19.814z" />
                                    <path d="M8.029,19.886c0.003,0.099-0.112,0.181-0.255,0.183c-0.143,0.003-0.26-0.077-0.261-0.174c0-0.1,0.113-0.181,0.256-0.184   C7.912,19.708,8.029,19.788,8.029,19.886L8.029,19.886z" />
                                    <path d="M8.943,19.731c0.017,0.096-0.082,0.196-0.224,0.222c-0.139,0.026-0.268-0.034-0.286-0.13   c-0.017-0.099,0.084-0.198,0.223-0.224C8.797,19.574,8.925,19.632,8.943,19.731L8.943,19.731z" />
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ -->
    <div id="faq" class="wrapper mx-auto">
        <div class="mb-5"></div>
        <h1 class="display-5 text-center mb-5" style="color: #074a81; font-weight: 700;">Frequently Asked Questions</h1>
        <div class="faq">
            <button class="accordion">
                Apakah itu INTI?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Inventaris Jurusan Teknologi Informasi (INTI) adalah sistem informasi berbasis website yang digunakan untuk
                    meningkatkan efisiensi proses peminjaman dan pengembalian barang serta berfungsi untuk mengelola keakuratan
                    data inventaris jurusan Teknologi Informasi Politeknik Negeri Malang.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Apa saja syarat untuk melakukan peminjaman?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Syarat untuk melakukan peminjaman barang inventaris adalah mahasiswa, dosen dan anggota aktif pada jurusan Teknologi Informasi.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Bagaimana alur peminjaman untuk Mahasiswa?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                <ol>
                    <li>Mahasiswa login pada sistem INTI.</li>
                    <li>Memilih barang yang ingin dipinjam.</li>
                    <li>Melakukan konfirmasi untuk barang-barang yang dipinjam.</li>
                    <li>Mengisi alasan peminjaman, tanggal peminjaman dan pengembalian serta WAJIB mengisi jaminan peminjaman berupa scan KTM.</li>
                    <li>Menunggu konfirmasi peminjaman yang dilakukan oleh teknisi.</li>
                    <li>Setelah peminjaman dikonfirmasi, Mahasiswa dapat mengambil barang sesuai instruksi yang terdapat pada pesan yang ada pada detail peminjaman.</li>
                    <li>Mengembalikan barang sesuai dengan tanggal pengembalian yang diisikan pada saat konfirmasi peminjaman.</li>
                </ol>
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Bagaimana alur peminjaman untuk Dosen?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                <ol>
                    <li>Dosen login pada sistem INTI.</li>
                    <li>Memilih barang yang ingin dipinjam.</li>
                    <li>Melakukan konfirmasi untuk barang-barang yang dipinjam.</li>
                    <li>Mengisi alasan peminjaman, tanggal peminjaman dan pengembalian.</li>
                    <li>Menunggu konfirmasi peminjaman yang dilakukan oleh teknisi.</li>
                    <li>Setelah peminjaman dikonfirmasi, Dosen dapat mengambil barang sesuai instruksi yang terdapat pada pesan yang ada pada detail peminjaman.</li>
                    <li>Mengembalikan barang sesuai dengan tanggal pengembalian yang diisikan pada saat konfirmasi peminjaman.</li>
                </ol>
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Apa saja barang jurusan yang bisa dipinjam?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Barang inventaris jurusan Teknologi Informasi yang dapat dipinjamkan terbagi menjadi 3 kategori,
                    yaitu Peralatan (seperti Tang Crimping dan Obeng),
                    Elektronik (seperti Konektor Proyektor, Keyboard, dan Mouse), dan ATK (seperti Spidol dan Penghapus Papan Tulis).
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Apakah ada denda apabila barang yang dipinjam rusak/hilang?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Jika terdapat kerusakan atau kehilangan, akan dikenakan sanksi yaitu menggantinya dengan barang yang baru pada saat pengembalian barang.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Berapakah jumlah maksimal barang yang bisa dipinjam?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Tidak ada batas maksimal peminjaman barang. Jumlah maksimal peminjaman barang tergantung pada jumlah stok barang yang tersedia.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                Dimana sajakah tempat pengambilan barang saat melakukan peminjaman?
                <i data-feather="chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    Untuk pengambilan barang berjenis Elektronik dan Peralatan dapat dilakukan di ruang teknisi pada lt.5 dan lt.7.
                    Sedangkan, barang berjenis ATK dapat diambil di ruang admin pada lt.6. Instruksi lebih jelas mengenai pengambilan
                    barang dapat ditemukan pada pesan yang terdapat pada detail peminjaman.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer" class="footer">
        <div class="d-flex mx-auto footer-container">
            <!-- Footer 1 -->
            <div class="footer-col">
                <ul>
                    <h4><b>JTI POLINEMA</b></h4>
                    <br>
                    <li>
                        <a href="">Jurusan Teknologi Informatika Politeknik
                            <br />Negeri Malang</a>
                    </li>
                    <li>
                        <a href="">Jl. Soekarno-Hatta No. 9 Malang 65141</a>
                    </li>
                    <li><a href="">Po.Box 04 Malang</a></li>
                    <li>
                        <a href="">Telepon : +62 (0341) 404424 – 404425</a>
                    </li>
                    <li><a href="">Faks : +62 (0341) 404420</a></li>
                </ul>
            </div>

            <!-- Footer 2 -->
            <div class="footer-col">
                <ul>
                    <h4><b>Blog</b></h4>
                    <br>
                    <li><a href="#faq">Aturan Peminjaman</a></li>
                    <li><a href="#faq">Syarat dan Ketentuan</a></li>
                </ul>
            </div>

            <!-- Footer 3 -->
            <div class="footer-col">
                <ul>
                    <h4><b>External</b></h4>
                    <br>
                    <li><a href="http://lms.jti.polinema.ac.id/">E-Learning</a></li>
                    <li><a href="http://jip.polinema.ac.id/ojs3/index.php/jip">Jurnal Informatika</a></li>
                    <li><a href="http://digilib.jti.polinema.ac.id/">Digital Library</a></li>
                    <li>
                        <a href="http://siakad.polinema.ac.id/">Siakad</a>
                    </li>
                    <li><a href="https://jpc.polinema.ac.id/">JPC Polinema</a></li>
                    <li><a href="http://p2m.polinema.ac.id/">Unit P2M Polinema</a></li>
                    <li><a href="http://beasiswa.polinema.ac.id/">Beasiswa</a></li>
                </ul>
            </div>

            <!-- Footer 4 -->
            <div class="footer-col">
                <ul>
                    <h4><b>Social Media</b></h4>
                    <br>
                    <li>
                        <a href="https://www.instagram.com/jtipolinema/">Instagram</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright ">
            Copyright &copy; 2023 Politeknik Negeri Malang. All Rights
            Reserved.
        </div>
    </div>

    </main>
    </div>

    <script>
        feather.replace();
    </script>

    <script>
        $(document).on('click', '.sidebar-btn', () => {
            $('.sidebar').toggleClass('active');
        })
    </script>


    <script>
        $(document).ready(function() {
            // Toggle hamburger menu
            $(document).on('click', '.hamburger-nav', function() {
                $('.nav-menu').toggleClass('nav-menu-active');
            });

            // Close menu on nav link click
            $('.nav-link').on('click', function() {
                $('.nav-menu').removeClass('nav-menu-active');
            });

            // Handle scroll events
            let lastScrollTop = 0;
            $(window).scroll(function() {
                const scrollTop = $(this).scrollTop();

                // Check scroll direction
                if (scrollTop < lastScrollTop) {
                    // Scrolling down
                    $('.nav').removeClass('nav-scroll-up').addClass('nav-scroll-down');
                } else {
                    // Scrolling up
                    $('.nav').removeClass('nav-scroll-down').addClass('nav-scroll-up');
                }

                lastScrollTop = scrollTop;
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.form-choose').trigger('reset');
            $('.form-choose-input-loan').on('click', function() {
                if ($(this).hasClass('form-choose-input-loan-non-active') && $(this).attr('checked') !== 'checked') {
                    $(this).removeClass('form-choose-input-loan-non-active');
                    $(this).addClass('form-choose-input-loan-active');
                    $(this).attr('checked', 'checked');
                } else {
                    $(this).removeClass('form-choose-input-loan-active');
                    $(this).addClass('form-choose-input-loan-non-active');
                    $(this).removeAttr('checked');
                }
            })
        })

        $(document).on('click', '.date-modal-button', () => {
            $('.calendar-modal-container').removeClass('d-none');
            console.log($('.calendar-modal-container').hasClass('d-none'))
        })

        $(document).ready(function() {

            /* This function is used to open the modal confirmation when the user click on the loan */
            $('.loan-button').on('click', function() {
                if ($('.loan-button').attr('disabled') !== 'disabled') {
                    $('.confirmation-modal-container').removeClass('d-none');
                }
            })

            /* This function is used to close the modal */
            $('.confirmation-modal-close').on('click', function() {
                $('.confirmation-modal-container').addClass('d-none');
            })

            /* This function is used to open the calendar modal when the user click on the Tanggal Peminjaman or Tanggal Pengembalian */

            /* This function is used to close the calendar modal */
            $(document).on('click', '.date-modal-close', function() {
                $('.calendar-modal-container').addClass('d-none');
            })

            $(document).on('click', '.button-submit-loan-application', () => {
                $('.success-loan-application-modal-container').removeClass('d-none');
            })

            $(document).on('click', '.loan-application-success-button', () => {
                $('.confirmation-modal-container').addClass('d-none');
                $('.success-loan-application-modal-container').addClass('d-none');
            })
        })
    </script>

    <!-- Ini khusus digunakan accordion -->
    <script>
        $(".accordion").click(function() {
            $(this).toggleClass("active");
            $(this).parent().toggleClass("active");

            const chevronIcon = $(this).find('svg')

            if (chevronIcon.hasClass('rotate-i')) {
                chevronIcon.removeClass("rotate-i");
                chevronIcon.addClass("rotate-start");
            } else {
                chevronIcon.addClass("rotate-i");
                chevronIcon.removeClass("rotate-start");
            }

            let panel = $(this).next();

            if (panel.is(":visible")) {
                panel.slideUp();
            } else {
                panel.slideDown();
            }
        });
    </script>

</body>

</html>