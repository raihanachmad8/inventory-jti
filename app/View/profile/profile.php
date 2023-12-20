<h3 class="px-4 py-lg-3 pt-5 pb-3 pt-lg-0 pb-lg-0">Akun</h3>
<div class="px-4 h-100 w-100 pb-4">
  <div class="w-100 h-100 bg-white d-flex justify-content-center align-items-center rounded-3 overflow-hidden ">
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

    <div id="profile-content" class="w-100 h-100 px-4 py-3 d-flex flex-column row-gap-2 ">
      <h4>Profil</h4>
      <?php View::getFlashData() ?>
      <?php if (isset($model['error'])) : ?>
        <div class="alert alert-danger" role="alert">
          <?= $model['error'] ?>
        </div>
    <?php endif; ?>
      <div class="d-flex justify-content-between border rounded-4 p-3 ">
        <div class="profile-info d-flex align-items-center flex-column flex-lg-row justify-content-center position-relative row-gap-4 row-gap-lg-0 ">
          <div class="me-3">
            <img src="/public/assets/images/profile/<?= $model['profile']->Foto ?? 'default.jpeg' ?>" style="width: 7rem; height: 7rem; border-radius: 50%; object-fit: contain; background-repeat: no-repeat; object-position: center;"  alt="default-profile">
          </div>
          <div>
            <h5 class="text-lg-start text-center"><strong><?= $model['profile']->Nama_Pengguna ?? "" ?></strong></h5>
            <p style="font-size: 1rem;" class="text-lg-start text-center "><?= $model['profile']->ID_Pengguna ?? "" ?></p>
          </div>
          <!-- Mobile -->
          <div class="d-lg-none position-absolute top-0 end-0">
            <button class="edit-profile-btn btn px-2 border rounded-3 " data-kode="<?= $model['profile']->ID_Pengguna ?? "" ?>">
              <img src="/public/assets/images/edit-icon.svg" alt="" class="me-2 ">Edit
            </button>
          </div>
        </div>
        <!-- Desktop -->
        <div class="d-none d-lg-block">
          <button class="edit-profile-btn btn px-2 border rounded-3 " data-kode="<?= $model['profile']->ID_Pengguna ?? "" ?>"><img src="/public/assets/images/edit-icon.svg" alt="" class="me-2 ">Edit</button>
        </div>
      </div>
      <div class="d-flex flex-column border rounded-4 p-3">
        <div class="d-flex justify-content-between ">
          <p style="font-size: 1rem; font-weight: 700;">Informasi Pribadi</p>
          <button class="edit-personal-info-btn btn px-2 border rounded-3 " data-kode="<?= $model['profile']->ID_Pengguna ?? "" ?>"><img src="/public/assets/images/edit-icon.svg" alt="" class="me-2 ">Edit</button>
        </div>
        <div class="personal-information-container">
          <div>
            <p class="text-black-50 " style="font-size: 0.8rem;">Email</p>
            <p><strong style="color: #001e3a; font-size: 0.9rem"><?= $model['profile']->Email ?? "" ?></strong></p>
          </div>
          <div>
            <p class="text-black-50 " style="font-size: 0.8rem;">Nomor Handphone</p>
            <p><strong style="color: #001e3a; font-size: 0.9rem;"><?= $model['profile']->Nomor_HP ?? "" ?></strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="edit-profile-modal d-none position-fixed z-3 vw-100 vh-100 start-0 flex bg-black bg-opacity-25  d-flex justify-content-center align-items-center">
  <div class="bg-white p-4 d-flex flex-column rounded-3" style="width: 25rem; height: 30rem; display:grid; grid-template-columns: 1fr; grid-template-rows: 1fr 1fr;">
    <div>
        <form action="/profile/profile/edit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id">
      <small>Edit Profil</small>
      <div class="d-flex justify-content-center align-items-center p-4 ">
        <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" alt="" style="width: 4rem; height: 4rem;">
      </div>
      <div>
        <label for="" style="font-size: 0.8rem;">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama" value="<?= $model['profile']->Nama_Pengguna ?? "" ?>" style="border: 1px solid #001e3a;">
      </div>
    </div>
    <div class="d-flex flex-column w-100 h-100 mt-2 ">
      <div class="d-flex flex-column w-100 h-100">
        <label for="foto" style="font-size: 0.8rem;">Foto Profil</label>
        <label for="foto" class="w-100 h-100 ">

          <input type="file" name="foto" id="foto" class="d-none">
          <div class="d-flex flex-column p-3  justify-content-center position-relative align-items-center rounded-3 w-100 h-100 border border-black ">
        <!-- Desktop -->
          <div class="foto-preview position-absolute rounded-3" style="width: 99%; height: 99%;  z-index: 0; object-fit: contain; background-repeat: no-repeat; object-position: center;"></div>
            <div style="z-index: 100;" class="d-flex flex-column p-3  justify-content-center position-relative align-items-center rounded-3">
              <div>
              <img src="/public/assets/images/file-upload-icon.svg" alt="">
              </div>
              <small>Drag and drop your file here (optional)</small>
              <small>or</small>
              <small class="fw-bold ">Klik Disini</small>
            </div>
          </div>
        </label>
      </div>
      <div class="d-flex justify-content-between mt-2 ">
        <button type="button" id="close-edit-profile-modal" class="btn btn-danger ">Batalkan</button>
        <button class="btn btn-primary ">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="edit-personal-information-modal d-none  position-fixed z-3 vw-100 vh-100 start-0 flex bg-black bg-opacity-25  d-flex justify-content-center align-items-center">
  <div class="bg-white p-4 d-flex flex-column rounded-3" style="width: 25rem; display:grid; grid-template-columns: 1fr; grid-template-rows: 1fr 1fr;">
    <form action="/profile/profile/edit/personal" method="post">
      <input type="hidden" name="id">
  <div>
      <small class="fw-bold ">Edit Informasi Pribadi</small>
      <div>
        <label for="" style="font-size: 0.8rem;">Email</label>
        <input type="email" class="form-control" name="email" value="<?= $model['profile']->Email ?? "" ?>" style="border: 1px solid #001e3a;">
        <?php if (isset($model['errors']['Email'])) : ?>
                <small class="text-danger">
                    <?php if (is_array($model['errors']['Email'])) : ?>
                        <div><?= $model['errors']['Email'][0] ?></div>
                    <?php else : ?>
                        <?= $model['errors']['Email'] ?>
                    <?php endif; ?>
                </small>
            <?php endif; ?>
      </div>
      <div>
        <label for="" style="font-size: 0.8rem;">Nomor</label>
        <input type="text" class="form-control" name="nomor-hp" value="<?= $model['profile']->Nomor_HP ?? "" ?>" style="border: 1px solid #001e3a;">
        <?php if (isset($model['errors']['Nomor_HP'])) : ?>
            <small class="text-danger">
                <?php if (is_array($model['errors']['Nomor_HP'])) : ?>
                    <div><?= $model['errors']['Nomor_HP'][0] ?></div>
                <?php else : ?>
                    <?= $model['errors']['Nomor_HP'] ?>
                <?php endif; ?>
            </small>
        <?php endif; ?>
      </div>
    </div>
    <div class="d-flex flex-column w-100 h-100 mt-2 ">
      <div class="d-flex justify-content-between mt-2 ">
        <button type="button" id="close-edit-personal-information-modal" class="btn btn-danger ">Batalkan</button>
        <button class="btn btn-primary ">Simpan</button>
      </div>
    </div>
</form>
  </div>
</div>


<script>
  $(document).ready(function() {
    $(document).on('click', '.edit-profile-btn', function() {
        const kode = $(this).data('kode')
        $.ajax({
            url: '/profile/profile/detail',
            method: 'GET',
            dataType: 'json',
            data: {
                kode: kode
            },
            success: function(data) {
                $(document).ready(function() {
                    
                    $('.edit-profile-modal input[name="nama"]').val(data.data.Nama_Pengguna)

                    $('.edit-profile-modal').removeClass('d-none')
                })
            }
        })
    })

    $(document).on('click', '.edit-personal-info-btn', function() {
        const kode = $(this).data('kode')
        $.ajax({
            url: '/profile/profile/detail',
            method: 'GET',
            dataType: 'json',
            data: {
                kode: kode
            },
            success: function(data) {
                $(document).ready(function() {
                    $('form').trigger('reset')
                    $('.edit-personal-information-modal input[name="email"]').val(data.data.Email)
                    $('.edit-personal-information-modal input[name="nomor-hp"]').val(data.data.Nomor_HP)

                    $('.edit-personal-information-modal').removeClass('d-none')
                })
            }
        })
    })

    $(document).on('click', '#close-edit-profile-modal', function() {
      $('.edit-profile-modal').addClass('d-none')
    })



    $(document).on('click', '#close-edit-personal-information-modal', function() {
      $('.edit-personal-information-modal').addClass('d-none')
    })
  })

  document.getElementById('foto').addEventListener('change', () => {
        let preview = document.querySelector('.foto-preview');
        let image = document.querySelector('#foto').files[0];
        let reader = new FileReader();

        reader.addEventListener('load', () => {
            preview.style.backgroundImage = `url(${reader.result})`;
        }, false);

        if (image) {
            reader.readAsDataURL(image);
        }
    })
</script>
