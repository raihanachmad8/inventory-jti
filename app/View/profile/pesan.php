<h3 class="px-4 py-lg-3 pt-5 pb-3 ">Akun</h3>
<div class="px-4 h-100 w-100 pb-4 ">
    <div class="w-100 h-100 bg-white d-flex justify-content-center align-items-center rounded-3 overflow-hidden">
        <nav class="h-100 bg-white p-3 d-none d-lg-block" style="width: 15rem; border-right: 1px solid #001e3a;">
            <ul class="d-flex flex-column row-gap-4">
                <li class="p-2 rounded-3" style="background-color: <?= active_page($current_page_url, $menu_items['profil']) ? "#001e3a" : "#fff" ?>;"><a href="/profile/profile" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['profil']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 1rem; font-weight: 500;">Profil</p>
                    </a></li>

                <li class="p-2 rounded-3" style="background-color: <?= active_page($current_page_url, $menu_items['keamanan']) ? "#001e3a" : "#fff" ?>;"><a href="/profile/keamanan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['keamanan']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 1rem; font-weight: 500;">Keamanan</p>
                    </a></li>

                <li class="p-2 rounded-3" style="background-color: <?= active_page($current_page_url, $menu_items['pesan']) ? "#001e3a" : "#fff" ?>;"><a href="/profile/pesan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['pesan']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 1rem; font-weight: 500;">Pesan</p>
                    </a></li>
                <li class="p-2 rounded-3 " style="background-color: <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "#001e3a" : "#fff" ?>;"><a href="/profile/hapus-akun" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 1rem; font-weight: 500;">Hapus Akun</p>
                    </a></li>
            </ul>
        </nav>

        <nav class="bg-white end-0  d-lg-none position-fixed fixed-bottom w-100 rounded-top-4">
            <ul class="d-flex justify-content-between  align-items-center row-gap-4 px-3 py-4 text-center ">
                <li class="<?= active_page($current_page_url, $menu_items['profil']) ? "bg-primary rounded-3 " : "" ?> p-2 "><a href="/profile/profile" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['profil']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 0.8rem; font-weight: 500;">Profile</p>
                    </a></li>
                <li class="p-2 <?= active_page($current_page_url, $menu_items['keamanan']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/keamanan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['keamanan']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 0.8rem; font-weight: 500;">Keamanan</p>
                    </a></li>
                <li class="p-2 <?= active_page($current_page_url, $menu_items['pesan']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/pesan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['pesan']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 0.8rem; font-weight: 500;">Pesan</p>
                    </a></li>
                <li class="p-2 <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/hapus-akun" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "#fff" : "#001e3a" ?>;">
                        <p style="font-size: 0.8rem; font-weight: 500;">Hapus Akun</p>
                    </a></li>
            </ul>
        </nav>

        <div class="w-100 h-100 px-4 py-3 d-flex flex-column row-gap-2 ">
            <h4>Pesan</h4>
            <div class="d-flex flex-column row-gap-3 column-gap-3">
                <?php if (count($model['message']) == 0) : ?>
                    <div class="d-flex  justify-content-center align-items-center w-100 h-100">
                        <p class="text-black-50">Tidak ada pesan</p>
                    </div>
                <?php else : ?>
                    <?php foreach ($model['message'] as $message) : ?>
                        <div class="d-flex column-gap-3 justify-content-center align-items-center w-100 h-100">
                            <div class="d-flex justify-content-between w-75 p-3 rounded-3 " style="background: #D8ECFF;">
                                <p style="color: #001e3a;"><?= $message['Pesan'] ?></p>
                            </div>
                            <div class="d-flex justify-content-between w-25 ">
                                <p><?= (new DateTime($message['Timestamp']))->format('h:i') ?></p>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- <div class="d-flex justify-content-between w-75 p-3 rounded-3 " style="background: #D8ECFF;">
          <p style="color: #001e3a;">Silahkan melakukan pengembalian di Ruang Admin Lt. 7</p>
        </div>
        <div class="d-flex justify-content-between w-25 ">
          <p>01.04 PM</p>
        </div> -->
            </div>
        </div>
    </div>
</div>
