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
      <h4>Keamanan</h4>
      <?php View::getFlashData() ?>
        <?php if (isset($model['error'])) : ?>
            <div class="alert alert-danger" role="alert">
            <?= $model['error'] ?>
            </div>
        <?php endif; ?>
      <div class="d-flex flex-column border rounded-4 p-3 row-gap-3 ">
        <div class="d-flex justify-content-between">
          <p style="font-weight: 700; font-size: 1rem">Informasi Akun</p>
          <button class="edit-account-btn btn px-2 border rounded-3 "><img src="/public/assets/images/edit-icon.svg" alt="" class="me-2 ">Edit</button>
        </div>
        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));">
          <div>
            <p class="text-black-50" style="font-size: 0.8rem;">Username</p>
            <p><strong style="color: #001e3a" style="font-size: 0.9rem;">19283471983</strong></p>
          </div>
          <div>
            <p class="text-black-50" style="font-size: 0.8rem;">Password</p>
            <p><strong style="color: #001e3a" style="font-size: 0.9rem;">***********</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="edit-account-modal d-none  position-fixed z-3 vw-100 vh-100 start-0 flex bg-black bg-opacity-25  d-flex justify-content-center align-items-center">
  <div class="bg-white p-4 d-flex flex-column rounded-3" style="width: 25rem; display:grid; grid-template-columns: 1fr; grid-template-rows: 1fr 1fr;">
<form action="/profile/keamanan/edit/security" method="post">
  <div>
      <small class="fw-bold ">Edit Informasi Akun</small>
      <div>
        <label for="" style="font-size: 0.8rem;">Username</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="********" style="border: 1px solid #022f63 !important;" required>
        <?php if (isset($model['errors']['Password'])) : ?>
            <small class="text-danger">
                <?php if (is_array($model['errors']['Password'])) : ?>
                    <div><?= $model['errors']['Password'][0] ?></div>
                <?php else : ?>
                    <?= $model['errors']['Password'] ?>
                <?php endif; ?>
            </small>
        <?php endif; ?>
      </div>
      <div>
        <label for="" style="font-size: 0.8rem;">Konfirmasi Password</label>
        <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="********" style="border: 1px solid #022f63 !important;" required>
        <?php if (isset($model['errors']['Password'])) : ?>
            <small class="text-danger">
                <?php if (is_array($model['errors']['Password'])) : ?>
                    <div><?= $model['errors']['Password'][0] ?></div>
                <?php else : ?>
                    <?= $model['errors']['Password'] ?>
                <?php endif; ?>
            </small>
        <?php endif; ?>
      </div>
    </div>
    <div class="d-flex flex-column w-100 h-100 mt-2 ">
      <div class="d-flex justify-content-between mt-2 ">
        <button type="button" id="close-edit-account" class="btn btn-danger ">Batalkan</button>
        <button type="submit"  class="btn btn-primary ">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-account-btn', function() {
      $('.edit-account-modal').removeClass('d-none')
    });

    $(document).on('click', '#close-edit-account', function() {
      $('.edit-account-modal').addClass('d-none')
    });
  });
</script>
