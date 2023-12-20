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
Router::get('/inventory/riwayat', [InventoryController::class, 'riwayat']);


// Router::get('/profile/profil', [InventoryController::class, 'profil']);
Router::get('/profile/profile', [ProfileManagementController::class, 'profile']);
Router::get('/profile/profile/detail', [ProfileManagementController::class, 'getProfileDetail']);
Router::post('/profile/profile/edit', [ProfileManagementController::class, 'postEditProfile']);
Router::post('/profile/profile/edit/personal', [ProfileManagementController::class, 'postEditPersonal']);
Router::post('/profile/keamanan/edit/security', [ProfileManagementController::class, 'postEditSecurity']);
// Router::post('/profile/profile/edit', [ProfileManagementController::class, 'postEditProfile']);
Router::get('/profile/keamanan', [ProfileManagementController::class, 'security']);
Router::get('/profile/pesan', [ProfileManagementController::class, 'message']);
Router::get('/profile/hapus-akun', [ProfileManagementController::class, 'deleteAccount']);



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



// require_once __DIR__ . '/../app/Repository/TransaksiRepository.php';
// require_once __DIR__ . '/../app/Repository/DetailTransaksiRepository.php';
// require_once __DIR__ . '/../app/Repository/InventarisRepository.php';
// require_once __DIR__ . '/../app/Repository/KategoriRepository.php';
// require_once __DIR__ . '/../app/Repository/MaintainerInventarisRepository.php';
// require_once __DIR__ . '/../app/Repository/MaintainerRepository.php';
// require_once __DIR__ . '/../app/Repository/PenggunaRepository.php';
// require_once __DIR__ . '/../app/Repository/StatusRepository.php';
// require_once __DIR__ . '/../app/Repository/LevelRepository.php';

//     class Example
//     {
//         private TransaksiRepository $transaksiRepository;
//         private DetailTransaksiRepository $detailTransaksiRepository;
//         private InventarisRepository $inventarisRepository;
//         private KategoriRepository $kategoriRepository;
//         private MaintainerRepository $maintainerRepository;
//         private MaintainerInventarisRepository $maintainerInventoryRepository;
//         private PenggunaRepository $penggunaRepository;
//         private StatusRepository $statusRepository;
//         private LevelRepository $levelRepository;

//         public function __construct()
//         {
//             $this->transaksiRepository = new TransaksiRepository();
//             $this->detailTransaksiRepository = new DetailTransaksiRepository();
//             $this->inventarisRepository = new InventarisRepository();
//             $this->kategoriRepository = new KategoriRepository();
//             $this->maintainerRepository = new MaintainerRepository();
//             $this->maintainerInventoryRepository = new MaintainerInventarisRepository();
//             $this->penggunaRepository = new PenggunaRepository();
//             $this->statusRepository = new StatusRepository();
//             $this->levelRepository = new LevelRepository();

//         }

//         // Assuming you have a method like getInventoryDetailsWithMaintainerAndCategory in your repository
//         public function calculate() {
//             $available = $this->transaksiRepository->avaibleStok();
//             $inventory = $this->maintainerInventoryRepository->getListMaintainerInventaris();
//             $inventory = array_map(function($item) {
//                 $item->Inventaris = $this->inventarisRepository->getInventarisById($item->ID_Inventaris);
//                 $item->Inventaris->Kategori = $this->kategoriRepository->getKategoriById($item->Inventaris->ID_Kategori);
//                 $item->Maintainer = $this->maintainerRepository->getMaintainerById($item->ID_Maintainer);
//                 return $item;
//             }, $inventory);
//             $filteredInventory = array_filter($inventory, function ($item) use ($available) {
//                 $totalBorrowed = array_reduce($available, function ($carry, $availableItem) use ($item) {
//                     if ($item->ID_Inventaris == $availableItem['ID_Inventaris']) {
//                         return $carry + $availableItem['TotalBorrowed'];
//                     }
//                     return $carry;
//                 }, 0);

//                 return ($item->Inventaris->Stok - $totalBorrowed) > 0;
//             });

//             // Sorting by AvailableStock in descending order
//             usort($filteredInventory, function($a, $b) {
//                 return $b->Inventaris->Stok - $this->getTotalBorrowed($b) - ($a->Inventaris->Stok - $this->getTotalBorrowed($a));
//             });

//             $result = array_map(function($item) {
//                 return [
//                     'ID_Inventaris' => $item->Inventaris->ID_Inventaris,
//                     'Nama_Inventaris' => $item->Inventaris->Nama_Inventaris,
//                     'Stok' => $item->Inventaris->Stok,
//                     'Gambar' => $item->Inventaris->Gambar,
//                     'Kategori' => $item->Inventaris->Kategori,
//                     'AvailableStock' => $item->Inventaris->Stok - $this->getTotalBorrowed($item),
//                     'MaintainerName' => $item->Maintainer->Nama_Maintainer, // Adjust this according to your Maintainer structure
//                 ];
//             }, $filteredInventory);


//             return $result;

//         }

//         private function getTotalBorrowed($item) {
//             $available = $this->transaksiRepository->avaibleStok();
//             return array_reduce($available, function ($carry, $availableItem) use ($item) {
//                 if ($item->ID_Inventaris == $availableItem['ID_Inventaris']) {
//                     return $carry + $availableItem['TotalBorrowed'];
//                 }
//                 return $carry;
//             }, 0);
//         }


//     }

// $example = new Example();
// // var_dump($example->calculate());
// $data = $example->calculate();
// $uniqueItems = [];

// // Iterate through the original data
// foreach ($data as $item) {
//     $key = $item['ID_Inventaris'] . $item['Nama_Inventaris'] . $item['Kategori']->ID_Kategori;

//     // Check if the combination already exists in the uniqueItems array
//     if (!isset($uniqueItems[$key])) {
//         $uniqueItems[$key] = [
//             'ID_Inventaris' => $item['ID_Inventaris'],
//             'Nama_Inventaris' => $item['Nama_Inventaris'],
//             'Kategori' => $item['Kategori'],
//             'Gambar' => $item['Gambar'],
//             'Stok' => $item['Stok'],
//             'AvailableStock' => $item['AvailableStock'],
//             'MaintainerNames' => [$item['MaintainerName']], // Initialize array with the first maintainer
//             // Add other fields as needed
//         ];
//     } else {
//         // If the combination already exists, add the maintainer to the existing array only if it doesn't already exist
//         if (!in_array($item['MaintainerName'], $uniqueItems[$key]['MaintainerNames'])) {
//             $uniqueItems[$key]['MaintainerNames'][] = $item['MaintainerName'];
//         }
//     }
// }

// // Iterate through the uniqueItems array to display the information
// foreach ($uniqueItems as $uniqueItem) {
//     echo '<div>';
//     echo '<img src="image_path">'; // Replace with the actual image path
//     echo '<p>ID_inven: ' . $uniqueItem['ID_Inventaris'] . '</p>';
//     echo '<p>Name: ' . $uniqueItem['Nama_Inventaris'] . '</p>';
//     echo '<p>Kategori: ' . $uniqueItem['Kategori']->Nama_Kategori . '</p>';
//     echo '<p>Stok: ' . $uniqueItem['Stok'] . '</p>';
//     echo '<p>Tersedia: ' . $uniqueItem['AvailableStock'] . '</p>';
//     echo '<p>Gambar: ' . $uniqueItem['Gambar'] . '</p>';

//     // Check if MaintainerNames is set and not empty
//     if (isset($uniqueItem['MaintainerNames']) && !empty($uniqueItem['MaintainerNames'])) {
//         // var_dump($uniqueItem['MaintainerNames']);
//         // var_dump(count($uniqueItem['MaintainerNames']) > 1);
//         $print = (count($uniqueItem['MaintainerNames']) > 1) ? $uniqueItem['MaintainerNames'][0] . ",..." : $uniqueItem['MaintainerNames'][0];
//         echo '<p>Maintainers: ' . $print  . '</p>';
//     }

//     echo '</div>';
// }

Router::run();
