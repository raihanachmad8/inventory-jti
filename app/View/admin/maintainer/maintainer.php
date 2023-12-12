<div class="container-fluid pt-lg-3 pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
    <div class="w-100 d-flex flex-column flex-lg-row row-gap-3 justify-content-between align-items-lg-center ">
        <h3 class="loans-heading">Maintainer</h3>
        <div class="h-100 d-flex justify-content-between column-gap-4 flex-column flex-lg-row row-gap-4">
            <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3 h-100">
                <input type="text" name="search" placeholder="Cari" class="w-100 px-3 rounded-3" style="border: none; outline: none; height: 2.5rem;">
                <div class="position-absolute bg-white" style=" width: 1.5rem; height: 1.5rem; right: 0.7rem;">
                    <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
                </div>
            </div>
            <button class="h-100 btn btn-success add-new-maintainer-button"><i data-feather="plus"></i>Tambah Maintainer</button>
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
                        <th>Nama Maintainer</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($model['maintainers'] && $model['maintainers'] !== [])) :  ?>
                        <?php foreach($model['maintainers'] as $model) : ?>
                        <tr>
                            <td ><?= $model->ID_Maintainer;?></td>
                            <td><?= $model->Nama_Maintainer; ?></td>
                            <td class="d-flex gap-3 align-items-center justify-content-center ">
                                <button class="btn edit-maintainer-button text-white" style="background-color: #01305D;"  data-kode="<?= $model->ID_Maintainer; ?>">Edit</button>
                                <button class="btn btn-danger delete-maintainer-button" data-kode="<?= $model->ID_Maintainer; ?>">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="edit-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="detail-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
        <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
            <form id="detail-item-form-edit" action="" class="flex-grow-1 w-100 h-100  column-gap-4 d-flex flex-wrap ">
                <div class="d-flex flex-column gap-3 input-container">
                    <strong><label for="">Kode Maintainer</label></strong>
                    <input type="text" class="border rounded bg-body p-2 " name="kode" value="">
                </div>
                <div class="d-flex flex-column gap-3 input-container">
                    <strong><label for="">Nama Maintainer</label></strong>
                    <input type="text" class="border rounded bg-body p-2 " name="nama" value="">
                </div>
            </form>
            <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
                <div class="flex-grow-1">
                    <button class="btn cancel-button-edit-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                    <button class="btn text-white confirm-button-edit-maintainer" style="height:fit-content; background-color: #01305D;">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal add -->
<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="add-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="detail-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
        <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
            <form id="detail-item-form-add" action="/admin/maintainer/post" method="post" class="flex-grow-1 w-100 h-100  column-gap-4 d-flex flex-wrap ">
                <div class="d-flex flex-column gap-3 input-container">
                    <strong><label for="">Kode Maintainer</label></strong>
                    <input type="text" class="border rounded bg-body p-2 " name="kode" placeholder="Masukkan Kode Maintainer">
                </div>
                <div class="d-flex flex-column gap-3 input-container">
                    <strong><label for="">Nama Maintainer</label></strong>
                    <input type="text" class="border rounded bg-body p-2 " name="nama" placeholder="Masukkan Nama Maintainer">
                </div>
            </form>
            <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
                <div class="flex-grow-1">
                    <button class="btn cancel-button-add-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                    <button class="btn text-white confirm-button-add-maintainer" style="height:fit-content; background-color: #01305D;">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi -->
<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="confirmation-add-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="confirmation-add-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
        <div class="flex-grow-1 d-flex flex-column w-100 p-4 row-gap-3 ">
            <h5><strong style="color: #01305D;">Konfirmasi Penambahan Maintainer</strong></h5>
            <div class="w-100 column-gap-4 d-flex flex-wrap ">
                <div class="d-flex flex-column gap-2" style="height: fit-content;">
                    <strong class="text-black-50">Kode Maintainer</strong>
                    <strong style="color: #01305D;" class="confirmation-item-code"></strong>
                </div>
                <div class="d-flex flex-column gap-2" style="height: fit-content;">
                    <strong class="text-black-50">Nama Maintainer</strong>
                    <strong style="color: #01305D;" class="confirmation-item-name"></strong>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
                <div class="flex-grow-1">
                    <button class="btn cancel-button-confirm-add-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                </div>
                <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                    <button class="btn text-white save-button-confirm-add-maintainer" style="height:fit-content; background-color: #01305D;">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(215,243,225,1) 65%);">
        <div class="d-flex flex-column align-items-center row-gap-3 ">
            <img src="/public/assets/images/berhasil.svg" alt="">
            <h3 style="color:#5BD794;">
                <strong id="maintainer-modal-container-title">
                    Berhasil
                </strong>
            </h3>
        </div>
        <div>
            <p id="maintainer-modal-container-message">Perubahan Maintainer Berhasil Disimpan</p>
        </div>
        <div>
            <button class="btn text-white maintainer-success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
        </div>
    </div>
</div>
<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="maintainer-modal-container-failed vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
        <div class="d-flex flex-column align-items-center row-gap-3 ">
        <img src="/public/assets/images/batalkan.svg" alt="">
            <h3 style="color:#CC3333;">
                <strong id="maintainer-modal-container-failed-title">
                    Gagal
                </strong>
            </h3>
        </div>
        <div>
            <p id="maintainer-modal-container-failed-message">Perubahan Gagal Disimpan</p>
        </div>
        <div>
            <button class="btn btn-danger text-white maintainer-success-button-back" style=" padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
        </div>
    </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="delete-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="delete-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
        <div class="d-flex flex-column align-items-center ">
            <img src="/public/assets/images/batalkan.svg" alt="">
            <h3 style="color: #CC3333;">
                <strong>
                    Hapus Maintainer
                </strong>
            </h3>
        </div>
        <div>
            <p class="text-center">Apakah Anda yakin ingin menghapus maintainer ini?</p>
        </div>
        <div class="d-flex gap-3 w-100 justify-content-evenly ">
            <button class="btn text-white delete-maintainer-button-back" style="background-color: #01305D; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
            <button class="btn btn-danger delete-maintainer-button-delete"><strong>Hapus</strong></button>
        </div>
    </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-delete-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="success-edit-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(215,243,225,1) 65%);">
        <div class="d-flex flex-column align-items-center row-gap-3 ">
            <img src="/public/assets/images/berhasil.svg" alt="">
            <h3 style="color:#5BD794;">
                <strong>
                    Berhasil
                </strong>
            </h3>
        </div>
        <div>
            <p>Data berhasil dihapus</p>
        </div>
        <div>
            <button class="btn text-white delete-maintainer-success-button" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.add-new-maintainer-button', () => {
        $('.add-maintainer-modal-container').toggleClass('d-none');
        $('#detail-item-form-add').trigger('reset');
    })

    $(document).on('click', '.cancel-button-add-maintainer', () => {
        $('.add-maintainer-modal-container').toggleClass('d-none');
    })

    $(document).on('click', '.confirm-button-add-maintainer', () => {
        $('.confirmation-add-maintainer-modal-container').toggleClass('d-none');
    })

    $(document).on('click', '.cancel-button-confirm-add-maintainer', () => {
        $('.confirmation-add-maintainer-modal-container').toggleClass('d-none');
    })

    $(document).on('click', '.save-button-confirm-add-maintainer', () => {
        $('.success-add-maintainer-modal-container').toggleClass('d-none');
    })

    document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
        const keyword = e.target.value;
        if (e.key === 'Enter') {
            window.location.href = `/admin/maintainer?search=${keyword}`;
        }
    })

    // confirmation-item-code

    document.querySelector('.confirm-button-add-maintainer').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('.confirmation-item-code').innerHTML = document.querySelector('#detail-item-form-add input[name="kode"]').value;
        document.querySelector('.confirmation-item-name').innerHTML = document.querySelector('#detail-item-form-add input[name="nama"]').value;
    })

    document.querySelector('.save-button-confirm-add-maintainer').addEventListener('click', function(e) {

        $.ajax({
            url: '/admin/maintainer/post',
            method: 'post',
            data: {
                kode: document.querySelector('#detail-item-form-add input[name="kode"]').value,
                nama: document.querySelector('#detail-item-form-add input[name="nama"]').value
            },
            success: (data) => {
                console.log(data)
                $(document).ready(function() {
                    $('.maintainer-modal-container').removeClass('d-none');
                    $('#maintainer-modal-container-title').html('Berhasil');
                    $('#maintainer-modal-container-message').html('Penambahan Maintainer Berhasil Dilakukan');

                })
            },
            error: (error) => {
                $(document).ready(function() {
                    console.log(error)
                    console.log(error.responseText)
                    $('.maintainer-modal-container-failed').removeClass('d-none');
                    $('#maintainer-modal-container-failed-title').html('Gagal');
                    $('#maintainer-modal-container-failed-message').html(`${error.responseText}`);

                })
            }
        })
    })

    $(document).on('click', '.cancel-button-edit-maintainer', () => {
        $('.edit-maintainer-modal-container').toggleClass('d-none');
    })

    document.querySelectorAll('.edit-maintainer-button').forEach((button) => {
        button.addEventListener('click', function(e) {
            $('.edit-maintainer-modal-container').toggleClass('d-none');
            e.preventDefault();
            const kode = $(this).data('kode');
            $('.detail-item-form-edit').trigger('reset');
            $.ajax({
                url: `/admin/maintainer/get?kode=${kode}`,
                method: 'GET',
                success: (data) => {
                    data = JSON.parse(data);
                    document.querySelector('#detail-item-form-edit input[name="kode"]').value = data.data.ID_Maintainer;
                    document.querySelector('#detail-item-form-edit input[name="nama"]').value = data.data.Nama_Maintainer;
                },
                error: (error) => {
                    console.log(error);
                }
            })
        });
    });

    $('.confirm-button-edit-maintainer').on('click', function(e) {
        e.preventDefault();
        $('.edit-maintainer-modal-container').toggleClass('d-none');
        const formData = new FormData(document.querySelector('#detail-item-form-edit'))
        console.log(JSON.stringify(Object.fromEntries(formData.entries())))
        $.ajax({
            url: '/admin/maintainer/update',
            method: 'PUT',
            data: JSON.stringify(Object.fromEntries(formData)),
            success: (data) => {
                console.log(data)
                $(document).ready(function() {
                    $('.maintainer-modal-container').removeClass('d-none');
                    $('#maintainer-modal-container-title').html('Berhasil');
                    $('#maintainer-modal-container-message').html('Perubahan Maintainer Berhasil Disimpan');

                })
            },
            error: (error) => {
                $(document).ready(function() {
                    console.log(error)
                    console.log(error.responseText)
                    $('.maintainer-modal-container-failed').removeClass('d-none');
                    $('#maintainer-modal-container-failed-title').html('Gagal');
                    $('#maintainer-modal-container-failed-message').html(`${error.responseText}`);

                })
            }
        })
    })

    // $('detail-item-form-edit')

    document.querySelectorAll('.delete-maintainer-button').forEach((button) => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const kode = $(this).data('kode');

            $('.delete-maintainer-modal-container').removeClass('d-none'); // Use removeClass instead of toggleClass
            $(document).on('click', '.delete-maintainer-button-delete', function () {
            // Get the kode from the data attribute of the clicked button
            $('.delete-maintainer-modal-container').addClass('d-none');
                console.log(kode);


                // Send the delete request for the specific maintainer
                $.ajax({
                    url: `/admin/maintainer/delete?kode=${kode}`,
                    method: 'delete',
                    success: function (data) {
                        console.log(data);
                        $('.maintainer-modal-container').toggle('d-none');
                        $('#maintainer-modal-container-title').html('Berhasil');
                        $('#maintainer-modal-container-message').html('Data berhasil dihapus');
                    },
                    error: function (error) {
                        console.log(error);
                        $('.maintainer-modal-container').toggle('d-none');
                        $('.maintainer-modal-container-failed').removeClass('d-none');
                        $('#maintainer-modal-container-failed-title').html('Gagal');
                        $('#maintainer-modal-container-failed-message').html(`${error.responseText}`);
                    }
                });
            });
        });
    });



    $(document).on('click', '.maintainer-success-button-back', () => {
        window.location.reload()
    })

    $(document).on('click', '.delete-maintainer-button', () => {
        window.location.reload()
    })


</script>
