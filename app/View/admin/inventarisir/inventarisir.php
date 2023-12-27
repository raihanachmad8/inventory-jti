<div class="container-fluid pt-lg-3 pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
    <div class="w-100 d-flex flex-column flex-lg-row row-gap-3 justify-content-between align-items-lg-center ">
        <h3 class="loans-heading">Inventarisir</h3>
        <div class="h-100 d-flex justify-content-between column-gap-4 flex-column flex-lg-row row-gap-4">
            <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3 h-100">
                <input type="text" placeholder="Cari" name="search-input" class="w-100 px-3 rounded-3" style="border: none; outline: none; height: 2.5rem;">
                <div class="position-absolute bg-white" style=" width: 1.5rem; height: 1.5rem; right: 0.7rem;">
                    <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
                </div>
            </div>
            <button class="h-100 btn btn-success add-new-item-button"><i data-feather="plus"></i>Tambah Barang</button>
        </div>
    </div>
</div>

<div class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
    <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
        <div class="overflow-y-scroll h-100">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Asal</th>
                        <th>Maintainer</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($model['inventarisir'])) : ?>
                        <?php foreach ($model['inventarisir'] as $invent) : ?>
                            <tr>
                                <td><?= $invent->ID_Inventaris ?></td>
                                <td><?= $invent->Nama_Inventaris ?></td>
                                <td><?= $invent->Stok ?></td>
                                <td><?= $invent->Asal ?></td>
                                <td><?= implode(', ', array_column($invent->MaintainerList, 'Nama_Maintainer')) ?></td>
                                <td><?= $invent->Inventaris->Kategori->Nama_Kategori ?></td>
                                <td><button class="button-detail-item btn" data-kode="<?= $invent->ID_Inventaris ?>" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Data Kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="background-color: rgba(0, 0, 0, 0.5);" class="detail-item-modal-container vw-100 position-fixed overflow-y-scroll d-none">
    <div class="detail-item-modal bg-light overflow-hidden rounded-4 ">
        <div class="order-last order-lg-first p-4 row-gap-3 d-flex flex-column overflow-y-scroll ">
            <form id="detail-item-form" action="" class="edit-item-form flex-grow-1 ">
                <div class="d-flex flex-column gap-3">
                    <label class="fw-semibold ">Kode Barang</label>
                    <p id="edit-kode"></p>
                    <input type="hidden" name="edit-kode">
                </div>
                <div>
                    <label class="fw-semibold " for="kategori">Kategori</label>
                    <select class="form-select" id="edit-kategori" name="edit-kategori" aria-label="Default select example">
                        <?php foreach ($model['kategori'] as $kategori) : ?>
                            <option value="<?= $kategori->ID_Kategori ?>"><?= $kategori->Nama_Kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-none">
                    <input type="file" name="edit-gambar" id="image-input">
                </div>
                <div>
                    <label class="fw-semibold " for="kategori">Kategori</label>
                    <select class="form-select" id="edit-kategori" name="edit-kategori" aria-label="Default select example">
                        <?php foreach ($model['kategori'] as $kategori) : ?>
                            <option value="<?= $kategori->ID_Kategori ?>"><?= $kategori->Nama_Kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="fw-semibold " for="namaBarang">Nama Barang</label>
                    <input type="text" id="namaBarang" class="border rounded bg-body form-control" name="edit-namaBarang">
                </div>
                <div>
                    <label class="fw-semibold " for="jumlahBarang">Jumlah Barang</label>
                    <input type="number" style="-moz-appearance: textfield; height: 3rem; border: 1px solid #023670; border-radius: 10px; " id="jumlahBarang" class="border rounded bg-body form-control" value="" name="edit-jumlahBarang">
                </div>
                <div class="d-flex flex-column flex-grow-1">
                    <label class="fw-semibold" for="asalBarang">Asal Barang</label>
                    <select class="form-select" id="edit-asal" name="edit-asal" aria-label="Default select example">
                        <?php foreach ($model['asal'] as $asal) : ?>
                            <option value="<?= $asal ?>"><?= $asal ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="grid-column: span 2;">
                    <p class="fw-semibold ">Maintainer</p>
                    <div style="display:grid; grid-template-columns: 1fr 1fr">
                        <?php foreach ($model['maintainer'] as $maintainer) : ?>
                            <div class="form-check d-flex align-items-center gap-3 gap-lg-2 ps-0 ">
                                <input class="form-check-input" name="maintainers[]" type="checkbox" value="<?= $maintainer->ID_Maintainer ?>" id="<?= $maintainer->ID_Maintainer ?>">
                                <label class="form-check-label" for="<?= $maintainer->ID_Maintainer ?>">
                                    <?= $maintainer->Nama_Maintainer ?>
                                </label>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div style="grid-column: span 2;">
                    <label class="fw-semibold " for="keterangan">Keterangan</label>
                    <textarea name="edit-keterangan" id="keterangan" class="h-100  border bg-body rounded p-2 form-control from-control-plaintext" style="resize: none;" value="Keyboard cetik cetik lurrr"></textarea>
                </div>
            </form>
            <div class="d-flex align-items-end justify-content-between pt-4 ">
                <div class="flex-grow-1">
                    <button class="btn cancel-button-detail-item" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                    <button class="delete-button-detail-item btn text-white" style="height:fit-content; background-color: #CC3333;">Hapus</button>
                    <button class="btn text-white save-button-detail-item" style="height:fit-content; background-color: #01305D;">Simpan</button>
                </div>
            </div>
        </div>
        <div class="h-100 position-relative w-100 ">
            <img src="" id="edit-detail-gambar" alt="" class="w-100 h-100 object-fit-contain" style="background-repeat: no-repeat; background-position: center center; background-size:contain;">
            <label for="image-input" class="w-100 h-100 position-absolute top-0 start-0 d-flex flex-column  justify-content-center align-items-center z-2 " style=" cursor: pointer;">
                <img src="/public/assets/images/images.svg" alt="" style="width: 5rem; height: 5rem;">
                <strong style="font-size: 1.5rem;" class="text-white">Edit</strong>
            </label>
            <div class="w-100 h-100 position-absolute top-0 start-0 d-flex justify-content-center align-items-center bg-black opacity-25"></div>
        </div>
    </div>
</div>

<div class="add-item-modal-container position-absolute top-0 start-0 d-flex flex-column row-gap-2 d-none " style="background-color: #ececec; box-sizing: border-box;">
    <div class="w-100 bg-white add-item-modal p-4 rounded-3 " style="box-sizing: border-box;">
        <form id="add-item-form" class="d-flex flex-column flex-lg-row w-100 h-100 gap-3" style="box-sizing: border-box;">
            <div class="flex-grow-1 w-100 h-100 d-flex flex-column row-gap-2">
                <div class="d-flex flex-column   ">
                    <label class="fw-semibold" for="namaBarang">Nama Barang</label>
                    <input id="namaBarang" type="text" class="border rounded bg-body p-2 " name="namaBarang" placeholder="Masukkan Nama Barang" required>
                </div>
                <div class="d-flex flex-wrap w-100 gap-2 flex-column flex-lg-row">
                    <div class="d-flex flex-column  flex-grow-1">
                        <label class="fw-semibold" for="jumlahBarang">Jumlah Barang</label>
                        <input id="jumlahBarang" type="number" min="0" name="jumlahBarang" class="border rounded bg-body p-2 " style="-moz-appearance: textfield; height: 3rem; border: 1px solid #023670; border-radius: 10px; " placeholder="Masukkan Jumlah Barang" required>
                    </div>
                    <div class="d-flex flex-column  flex-grow-1">
                        <label class="fw-semibold" for="asalBarang">Asal Barang</label>
                        <select id="asalBarang" class="form-select p-2" name="asal" aria-label="Default select example" required>
                            <?php foreach ($model['asal'] as $asal) : ?>
                                <option value="<?= $asal ?>"><?= $asal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column  flex-grow-1 w-100 ">
                        <label class="fw-semibold" for="kategori">Kategori</label>
                        <select id="kategori" class="form-select" name="kategori" aria-label="Default select example" required>
                            <?php foreach ($model['kategori'] as $kategori) : ?>
                                <option value="<?= $kategori->ID_Kategori ?>"><?= $kategori->Nama_Kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column  flex-grow-1 w-100 ">
                        <p class="fw-semibold">Maintainer</p>
                        <div class="maintainer-">
                            <?php foreach ($model['maintainer'] as $maintainer) : ?>
                                <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                                    <input class="form-check-input" name="maintainers[]" type="checkbox" value="<?= $maintainer->ID_Maintainer ?>" id="<?= $maintainer->ID_Maintainer ?>">
                                    <label class="form-check-label" for="<?= $maintainer->ID_Maintainer ?>">
                                        <?= $maintainer->Nama_Maintainer ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p style="color: #CC3333;" class="d-none position-relative maintainer-required my-1">Maintainer is required </p>
                    </div>
                </div>
                <div class="d-flex flex-column  h-100 ">
                    <label class="fw-semibold" for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" cols="30" style="resize: none;" placeholder="Masukkan Keterangan" class="border rounded bg-body p-2 h-100"></textarea>
                </div>
            </div>
            <div class="image-upload-button-container flex-grow-1 d-flex flex-column justify-content-lg-center justify-content-start  align-items-center">
                <div class="flex-md-grow-1 w-100 position-relative">
                    <p class="fw-semibold">Gambar</p>
                    <input type="file" class="d-none " name="gambar" draggable="true" id="add-item-image-input">
                    <label for="add-item-image-input" class="position-relative d-flex justify-content-center align-items-center rounded-2" style="height: 90%; cursor: pointer; border:4px dotted rgba(0, 0, 0, 0.25);">
                        <div class="d-flex justify-content-center align-items-center flex-column h-75 row-gap-5 p-4 p-md-0">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="80" height="80">
                                <path fill="#dee2e6" d="M9,5.5c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Zm15-.5v6c0,2.76-2.24,5-5,5H10c-2.76,0-5-2.24-5-5V5C5,2.24,7.24,0,10,0h9c2.76,0,5,2.24,5,5ZM7,11c0,.77,.29,1.47,.77,2.01l5.24-5.24c.98-.98,2.69-.98,3.67,0l1.04,1.04c.23,.23,.62,.23,.85,0l3.43-3.43v-.38c0-1.65-1.35-3-3-3H10c-1.65,0-3,1.35-3,3v6Zm15,0v-2.79l-2.02,2.02c-.98,.98-2.69,.98-3.67,0l-1.04-1.04c-.23-.23-.61-.23-.85,0l-4.79,4.79c.12,.02,.24,.02,.37,.02h9c1.65,0,3-1.35,3-3Zm-3.91,7.04c-.53-.15-1.08,.17-1.23,.7l-.29,1.06c-.21,.77-.71,1.42-1.41,1.81-.7,.4-1.51,.5-2.28,.29l-8.68-2.38c-1.6-.44-2.54-2.09-2.1-3.69l.96-3.56c.14-.53-.17-1.08-.7-1.23-.53-.14-1.08,.17-1.23,.7L.18,15.29c-.73,2.66,.84,5.42,3.5,6.15l8.68,2.38c.44,.12,.89,.18,1.33,.18,.86,0,1.7-.22,2.47-.66,1.16-.66,1.99-1.73,2.35-3.02l.29-1.06c.15-.53-.17-1.08-.7-1.23Z" />
                            </svg>
                            <p class="fw-semibold text-black-50 ">Upload</p>
                        </div>
                    </label>
                    <p style="color: #CC3333;" class="d-none position-relative add-image-required my-1">Image is required </p>
                </div>
                <div class="w-100 d-flex align-items-end ">
                    <div class="d-flex gap-3 w-100 ">
                        <!-- Harusnya ini button -->
                        <div class="btn cancel-button-add-item w-100 " style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</div>
                        <!-- Harusnya ini button -->
                        <button type="submit" class="btn text-white w-100 confirm-button-add-item " style="height:fit-content; background-color: #01305D;">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div style="background-color: rgba(0, 0, 0, 0.5);" class="confirmation-add-item-modal-container vw-100 position-fixed overflow-y-scroll d-none">
    <div class="confirmation-add-item-modal bg-light overflow-hidden">
        <div class="order-last order-lg-first p-4 row-gap-3 d-flex flex-column  overflow-y-scroll ">
            <h4 class="fw-bold " style="color: #01305D;">Konfirmasi Penambahan Barang</h4>
            <div action="" class="confirmation-add-item flex-grow-1 ">
                <div>
                    <p style="font-size: 0.8rem" class="text-black-50">Kategori</p>
                    <strong style="color: #01305D;" id="confirmation-kategori">Ayam</strong>
                </div>
                <div>
                    <p style="font-size: 0.8rem" class="text-black-50">Nama Barang</p>
                    <strong style="color: #01305D;" id="confirmation-namaBarang">awdada</strong>
                </div>
                <div>
                    <p style="font-size: 0.8rem" class="text-black-50">Jumlah Barang</p>
                    <strong style="color: #01305D;" id="confirmation-jumlahBarang">3</strong>
                </div>
                <div>
                    <p style="font-size: 0.8rem" class="text-black-50">Asal Barang</p>
                    <strong style="color: #01305D;" id="confirmation-asal">awdad</strong>
                </div>
                <div style="grid-column: span 2;">
                    <p style="font-size: 0.8rem" class="text-black-50">Maintainer</p>
                    <strong style="color: #01305D;" id="confirmation-maintainer">awdawd, awda, awda</strong>
                </div>
                <div style="grid-column: span 2;">
                    <p style="font-size: 0.8rem" class="text-black-50">Keterangan</p>
                    <p style="color: #01305D; max-width: 100%;" id="confirmation-keterangan">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam quo quia rerum at asperiores nisi modi adipisci rem? Quam id nemo, accusamus vero incidunt quo dolor pariatur dolorum ducimus! Dolore odit veritatis iure, error ut quibusdam optio porro quos mollitia necessitatibus consequatur ex impedit hic perspiciatis laborum beatae a? Dolores quas repellendus id maiores voluptates?</p>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
                <div class="flex-grow-1">
                    <button class="btn cancel-button-confirm-add-item" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                    <button class="btn text-white save-button-confirm-add-item" style="height:fit-content; background-color: #01305D;">Simpan</button>
                </div>
            </div>
        </div>
        <div class="flex-grow-1 w-100 h-100 position-relative ">
            <img src="" alt="" class="confirmation-image-preview w-100 h-100 object-fit-cover" style="background-repeat: no-repeat; background-size:contain; background-position: center;">
            <div class="w-100 h-100 position-absolute top-0 start-0 d-flex justify-content-center align-items-center bg-black opacity-25"></div>
        </div>
    </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="delete-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="delete-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
        <div class="d-flex flex-column align-items-center ">
            <img src="/public/assets/images/batalkan.svg" alt="">
            <h3 style="color: #CC3333;">
                <strong>
                    Hapus Barang
                </strong>
            </h3>
        </div>
        <div>
            <p>Apakah Anda yakin ingin menghapus barang ini?</p>
        </div>
        <div class="d-flex gap-3 w-100 justify-content-evenly ">
            <button class="btn text-white delete-item-button-back" style="background-color: #01305D; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
            <button class="btn btn-danger delete-item-button"><strong>Hapus</strong></button>
        </div>
    </div>
</div>

<script>
    $('input[name="search-input"]').keypress(function(e) {
        const keyword = e.target.value;
        if (e.key === 'Enter') {
            window.location.href = `/admin/inventarisir?search=${keyword}`;
        }
    })
    /* Button tambah barang */
    $(document).on('click', '.add-new-item-button', () => {
        $('#add-item-form').trigger('reset');
        $('.add-item-modal-container').removeClass('d-none');
    })

    /* Setelah button tambah barang di klik akan muncul popup untuk ngisi data barang
    ini digunakan ketika button batalkan di klik */
    $(document).on('click', '.cancel-button-add-item', () => {
        $('.add-item-modal-container').addClass('d-none');
    })
    /* ini digunakan ketika button konfirmasi diklik */
    $(document).on('click', '.confirm-button-add-item', (e) => {
        e.preventDefault();
        const form = document.querySelector('#add-item-form');
        const formData = new FormData(form);
        formData.forEach((value, key) => {
            if (key !== 'maintainers[]') {
                $(`#confirmation-${key}`).html(value);
            } else {
                const checkboxes = form.querySelectorAll('input[name="maintainers[]"]');
                const checked = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
                $(`#confirmation-maintainer`).html(checked.join(', '));
                formData.set(key, checked);
            }
        })

        let checkboxes = form.querySelectorAll('input[name="maintainers[]"]');
        const file = document.querySelector('#add-item-image-input')
        let isAtLeastOneChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isAtLeastOneChecked) {
            $('.maintainer-required').removeClass('d-none');
        } else {
            $('.maintainer-required').addClass('d-none');
        }
        if (file.files.length === 0) {
            $('.add-image-required').removeClass('d-none');
        } else {
            $('.add-image-required').addClass('d-none');
        }
        if (form.checkValidity() && isAtLeastOneChecked && file.files.length !== 0) {
            $('.confirmation-add-item-modal-container').removeClass('d-none');

        } else {
            form.reportValidity();
        }
    })

    $('.save-button-confirm-add-item').click(() => {
        const form = document.querySelector('#add-item-form');
        const formData = new FormData(form)
        $('.confirmation-add-item-modal-container').addClass('d-none');
        $.ajax({
            url: '/admin/inventarisir/post',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                $(document).ready(function() {
                    $('.modal-container').removeClass('d-none');
                    $('#modal-container-title').html('Berhasil');
                    $('#modal-container-message').html(data.message);

                })
            },
            error: (error) => {
                $(document).ready(function() {
                    $('.modal-container-failed').removeClass('d-none');
                    $('#modal-container-failed-title').html('Gagal');
                    $('#modal-container-failed-message').html(error.responseJSON.error);

                })
            }
        })
    })


    /* Ketika tombol konfirmasi di klik akan muncul popup lagi yang digunakan untuk konfirmasi
    ini digunakan ketika button batalkan di klik */
    $(document).on('click', '.cancel-button-confirm-add-item', () => {
        $('.confirmation-add-item-modal-container').addClass('d-none');
    })


    document.getElementById('image-input').addEventListener('change', () => {
        let preview = document.querySelector('#edit-detail-gambar');
        let confirmationPreview = document.querySelector('.confirmation-image-preview');
        let image = document.querySelector('#image-input').files[0];
        let reader = new FileReader();

        reader.addEventListener('load', () => {
            preview.style.backgroundImage = `url(${reader.result})`;
            confirmationPreview.style.backgroundImage = `url(${reader.result})`;
        }, false);

        if (image) {
            preview.classList.remove('d-none');
            reader.readAsDataURL(image);
            $('#edit-detail-gambar').attr('src', '')
        }

    })

    $(document).on('click', '.inventaris-success-button-back', () => {
        window.location.reload()
    })

    $(document).on('click', '.delete-maintainer-button', () => {
        window.location.reload()
    })

    /* Bagian ini digunakan pada tombol detail pada tabel */


    /* Lalu akan muncul popup untuk detail barang */
    /* Ini digunakan ketika tombol batalkan di click */
    $(document).on('click', '.cancel-button-detail-item', () => {
        $('.detail-item-modal-container').addClass('d-none');
    })

    // Edit

    function debounce(func, delay) {
        let timeoutId;

        return function() {
            const context = this;
            const args = arguments;

            clearTimeout(timeoutId);
            timeoutId = setTimeout(function() {
                func.apply(context, args);
            }, delay);
        };
    }

    const handleDetail = debounce((kode) => {
        $.ajax({
            url: `/admin/inventarisir/get?kode=${kode}`,
            method: 'GET',
            success: (data) => {
                $(document).ready(async () => {
                    $('#detail-item-form').trigger('reset');
                    $('#edit-kode').html(data.data.Inventaris.ID_Inventaris);
                    $('input[name="edit-kode"]').val(data.data.Inventaris.ID_Inventaris);
                    $('.delete-button-detail-item').data('kode', data.data.Inventaris.ID_Inventaris)
                    $('.detail-item-modal-container').removeClass('d-none');
                    $('input[name="edit-namaBarang"]').val(data.data.Inventaris.Nama_Inventaris);
                    $('input[name="edit-jumlahBarang"]').val(data.data.Inventaris.Stok);
                    $('#edit-asal').val(data.data.Inventaris.Asal);
                    $('#edit-kategori').val(data.data.Inventaris.Kategori.ID_Kategori);
                    $('#keterangan').val(data.data.Keterangan);
                    $('textarea[name="edit-keterangan"]').val(data.data.Inventaris.Deskripsi);
                    // sek bug

                    $('#edit-detail-gambar').attr('src', '').css('background-image', 'none');


                    $('#edit-detail-gambar').attr('src', `/public/assets/images/inventarisir/${data.data.Inventaris.Gambar}`);

                    $('input[name="maintainers[]"]').each(function() {
                        if (data.data.MaintainerList.some(maintainer => maintainer.ID_Maintainer === $(this).val())) {
                            $(this).prop('checked', true);
                        }
                    })
                    // $(document).on('click', '.button-detail-item', () => {
                    $('.detail-item-modal-container').removeClass('d-none');
                    // })
                })
            },
            error: (error) => {
                $(document).ready(function() {
                    $('.modal-container-failed').removeClass('d-none');
                    $('#modal-container-failed-title').html('Gagal');
                    $('#modal-container-failed-message').html(error.responseJSON.error);

                })
            }
        })
    }, 700)

    $('.button-detail-item')
        .each(function() {
            $(this).click(function() {
                const kode = $(this).data('kode');
                handleDetail(kode)

            })
        })

    $(document).on('click', '.delete-button-detail-item', () => {
        $('.delete-item-modal-container').removeClass('d-none');
    })

    // ini digunakan ketika tombol kembali pada popup berhasil menghapus di klik
    $(document).on('click', '.delete-item-button-back', () => {
        $('.delete-item-modal-container').addClass('d-none');
    })

    $('.delete-item-button').click((e) => {
        e.preventDefault();
        const kode = $('.delete-button-detail-item').data('kode');
        $.ajax({
            url: `/admin/inventarisir/delete?kode=${kode}`,
            method: 'DELETE',
            success: (data) => {
                $(document).ready(function() {
                    $('.delete-item-modal-container').addClass('d-none');
                    $('.modal-container').removeClass('d-none');
                    $('#modal-container-title').html('Berhasil');
                    $('#modal-container-message').html(data.message);

                })
            },
            error: (error) => {
                $(document).ready(function() {
                    $('.modal-container-failed').removeClass('d-none');
                    $('#modal-container-failed-title').html('Gagal');
                    $('#modal-container-failed-message').html(error.responseJSON.error);

                })
            }
        })
    })

    $('.save-button-detail-item').click(() => {
        const form = document.querySelector('#detail-item-form');
        const formData = new FormData(form);
        $('.detail-item-modal-container').addClass('d-none');
        $.ajax({
            url: '/admin/inventarisir/update',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                $(document).ready(function() {
                    $('.modal-container').removeClass('d-none');
                    $('#modal-container-title').html('Berhasil');
                    $('#modal-container-message').html(data.message);
                })
            },
            error: (error) => {
                $(document).ready(function() {
                    $('.modal-container-failed').removeClass('d-none');
                    $('#modal-container-failed-title').html('Gagal');
                    $('#modal-container-failed-message').html(error.responseJSON.error);
                })
            }
        })
    })

    $(document).on('click', '.delete-maintainer-button', () => {
        window.location.reload()
    })

    $(document).on('click', '.maintainer-failed-button-back', () => {
        $('.inventarisir-modal-container-failed').addClass('d-none');
    })
</script>
