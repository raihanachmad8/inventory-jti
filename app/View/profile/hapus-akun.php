<h3 class="px-4 py-lg-3 pt-5 pb-3 pt-lg-0 pb-lg-0">Akun</h3>
<div class="px-4 h-100 w-100 pb-4 ">
  <div class="w-100 h-100 bg-white d-flex justify-content-center align-items-center rounded-3 overflow-hidden">
    <nav class="h-100 bg-white p-3 d-none d-lg-block" style="width: 15rem; border-right: 1px solid #001e3a;">
      <ul class="d-flex flex-column row-gap-4">
        <li class="<?= active_page($current_page_url, $menu_items['profil']) ? "bg-primary rounded-3 " : "" ?> p-2 "><a href="/profile/profil" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['profil']) ? "#fff" : "#001e3a" ?>;">
            <p style="font-size: 1rem; font-weight: 500;">Profile</p>
          </a></li>

        <li class="p-2 <?= active_page($current_page_url, $menu_items['keamanan']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/keamanan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['keamanan']) ? "#fff" : "#001e3a" ?>;">
            <p style="font-size: 1rem; font-weight: 500;">Keamanan</p>
          </a></li>


        <li class="p-2 <?= active_page($current_page_url, $menu_items['pesan']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/pesan" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['pesan']) ? "#fff" : "#001e3a" ?>;">
            <p style="font-size: 1rem; font-weight: 500;">Pesan</p>
          </a></li>
        <li class="p-2 <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "bg-primary rounded-3" : "" ?>"><a href="/profile/hapus-akun" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['hapus-akun']) ? "#fff" : "#001e3a" ?>;">
            <p style="font-size: 1rem; font-weight: 500;">Hapus Akun</p>
          </a></li>
      </ul>
    </nav>

    <nav class="bg-white end-0  d-lg-none position-fixed fixed-bottom w-100 rounded-top-4">
      <ul class="d-flex justify-content-between  align-items-center row-gap-4 px-3 py-4 text-center ">
        <li class="<?= active_page($current_page_url, $menu_items['profil']) ? "bg-primary rounded-3 " : "" ?> p-2 "><a href="/profile/profil" class="nav-link" style="color: <?= active_page($current_page_url, $menu_items['profil']) ? "#fff" : "#001e3a" ?>;">
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
      <h4>Hapus Akun</h4>
      <div class="d-flex justify-content-between">
        <div class="d-flex flex-column row-gap-3 align-items-center justify-content-center text-black-50 ">
          <p>Perhatikan bahwa jika Anda menghapus akun Anda, semua pesan dan notifikasi Anda akan terhapus dan tidak dapat diambil kembali. Ini adalah perjalanan satu arah.</p>
          <p>Peringatan! Harap hanya menghapus akun Anda jika Anda menghapus akun Anda sekarang, mungkin tidak dapat mendaftar lagi selama beberapa hari.</p>
          <ul class="w-100 text-start ">
            <li>- Jika Anda ingin mengubah informasi pribadi Anda, klik profil.</li>
            <li>- Proses menghapus akun akan otomatis gagal ketika ada peminjaman yang belum selesai.</li>
          </ul>
        </div>
      </div>
      <div class="d-flex flex-column rounded-4 row-gap-3 ">
        <div>
          <button class="btn btn-danger float-end ">Hapus Akun</button>
        </div>
      </div>
    </div>
  </div>
</div>