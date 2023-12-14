<div class="container-fluid pt-lg-3 pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
  <div class="w-100 d-flex flex-column flex-lg-row row-gap-3 justify-content-between align-items-lg-center ">
    <h3 class="loans-heading">Data Peminjaman</h3>
    <div class="h-100 d-flex justify-content-between column-gap-4 flex-column flex-lg-row row-gap-4">
      <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3 h-100">
        <input type="text" placeholder="Cari" class="w-100 px-3 rounded-3" style="border: none; outline: none; height: 2.5rem;" name="search-input">
        <div class="position-absolute bg-white" style=" width: 1.5rem; height: 1.5rem; right: 0.7rem;">
          <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
        </div>
      </div>
    </div>
  </div>
</div>

<div id="data-peminjaman" class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100 ">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-y-scroll">
    <div class="h-100">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Status Peminjam</th>
            <th>Waktu<br>Peminjaman</th>
            <th>Waktu<br>Pengembalian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            <?php if (isset($model['peminjaman'])) :?>
                <?php foreach ($model['peminjaman'] as $transaksi) : ?>
                <tr>
                    <td><?= $transaksi->Pengguna->Nomor_Identitas ?></td>
                    <td><?= $transaksi->Pengguna->Nama_Pengguna ?></td>
                    <td><?= $transaksi->Pengguna->Level->Nama_Level ?></td>
                    <td><?= (new DateTime($transaksi->StartDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;" ><?= (new DateTime($transaksi->StartDate))->format('h:i A') ?></span></td>
                    <td><?= (new DateTime($transaksi->EndDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;" ><?= (new DateTime($transaksi->EndDate))->format('h:i A') ?></span></td>
                    <td><button class="loan--details-button--approval btn" style="background-color: #CEE7FF; color:#01305D;" data-kode="<?= $transaksi->ID_Transaksi?>">Detail</button></td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal-detail-container position-absolute px-4  w-100 h-100 bg-white d-flex flex-column justify-content-between overflow-y-scroll d-none " style="color: #01305D;">
  <div class="w-100 text-center bg-warning p-2 rounded-2 ">
    <strong class="text-white">Detail Peminjaman</strong>
  </div>
  <div class="pt-4 ">
    <form id="detail-peminjaman-form">
    <input type="hidden" name="kode" value="">
    <table class="identity-table">
      <tbody>
        <tr>
          <td><strong>Jenis Peminjam</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p id="status-peminjam"></p>
          </td>
        </tr>
        <tr>
          <td><strong>Nama</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p id="nama"></p>
          </td>
        </tr>
        <tr>
          <td><strong>Nomor ID</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p id="nomor-identitas"></p>
          </td>
        </tr>
        <tr>
          <td><strong>Admin</strong></td>
          <td><strong>:</strong></td>
          <td>
            <select class="form-select" aria-label="Default select example" name="maintainer" style="max-width: 200px;">
                <?php foreach($model['maintainer'] as $maintainer) : ?>
                    <option value="<?= $maintainer->ID_Maintainer ?>"><?= $maintainer->Nama_Maintainer ?></option>
                <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <select class="form-select" aria-label="Default select example" name="status" style="max-width: 200px;">
            <?php foreach($model['status'] as $status) : ?>
                    <option value="<?= $status->ID_Status ?>"><?= $status->Nama_Status ?></option>
                <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Tanggal Peminjaman</strong></td>
          <td>:</td>
          <td>
            <p id="start-date"></p>
          </td>
        </tr>
        <tr>
          <td><strong>Waktu Pengembalian</strong></td>
          <td>:</td>
          <td>
            <p id="end-date"></p>
          </td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td><textarea name="pesan" class="admin-retrieval-information p-2 rounded-2 border border-light-subtle"  id="" cols="30" rows="1" type="text" style="resize: none;"></textarea></td>
        </tr>
        <tr>
          <td><strongd>Alasan Peminjaman</strongd></td>
          <td><strong>:</strong></td>
          <td>
            <p id="deskripsi-keperluan"></p>
          </td>
        </tr>
        <tr id="tanda-pengenal">

        </tr>
      </tbody>
    </table>
    </form>
  </div>
  <div class="h-100">
    <h5 class="py-3 "><strong>Daftar Pengembalian</strong></h5>
    <div class="w-100">
      <table class="loan-detail-table w-100 text-center ">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kategori</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="py-4 d-flex justify-content-end column-gap-3 ">
    <button class="button-back-loan btn text-white" style="background-color: #01305D;">Kembali</button>
    <button class="button-save-loan btn text-white " style="background-color: #FFB733">Simpan</button>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="peminjaman-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(215,243,225,1) 65%);">
        <div class="d-flex flex-column align-items-center row-gap-3 ">
            <img src="/public/assets/images/berhasil.svg" alt="">
            <h3 style="color:#5BD794;">
                <strong id="peminjaman-modal-container-title">
                    Berhasil
                </strong>
            </h3>
        </div>
        <div>
            <p id="peminjaman-modal-container-message">Perubahan Peminjaman Berhasil Disimpan</p>
        </div>
        <div>
            <button class="btn text-white peminjaman-success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
        </div>
    </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="peminjaman-modal-container-failed vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
    <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
        <div class="d-flex flex-column align-items-center row-gap-3 ">
            <img src="/public/assets/images/batalkan.svg" alt="">
            <h3 style="color:#CC3333;">
                <strong id="peminjaman-modal-container-failed-title">
                    Gagal
                </strong>
            </h3>
        </div>
        <div>
            <p id="peminjaman-modal-container-failed-message">Perubahan Gagal Disimpan</p>
        </div>
        <div>
            <button class="btn btn-danger text-white peminjaman-failed-button-back" style=" padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
        </div>
    </div>
</div>


<script>
    $('input[name="search-input"]').keypress(function(e) {
        const keyword = e.target.value;
        if (e.key === 'Enter') {
            window.location.href = `/admin/data-peminjaman?search=${keyword}`;
        }
    })



    $('.loan--details-button--approval').each(function() {
            $(this).click(async function() {
                const kode = $(this).data('kode');
                await $.ajax({
                    url: '/admin/data-peminjaman/get?kode=' + kode,
                    method: "GET",
                    success: (data) => {
                        $(document).ready(() => {
                            const options = {
                                year: "numeric",
                                month: "long",
                                day: "numeric",
                                hour: "numeric",
                                minute: "numeric",
                                hour12: false, // Use 24-hour format
                            };
                            $('input[name="kode"]').val(data.data.ID_Transaksi);
                            $('#status-peminjam').html(data.data.Pengguna.Level.Nama_Level);
                            $('#nama').html(data.data.Pengguna.Nama_Pengguna);
                            $('#nomor-identitas').html(data.data.Pengguna.Nomor_Identitas);
                            $('#start-date').html(new Date(data.data.StartDate).toLocaleDateString("id-ID", options));
                            $('#end-date').html(new Date(data.data.EndDate).toLocaleDateString("id-ID", options));
                            $('#deskripsi-keperluan').html(data.data.Deskripsi_Keperluan);
                            if (data.data.Pesan != null) {
                                $('.admin-retrieval-information').val(data.data.Pesan);
                            }
                            if (data.data.Pengguna.Level.Nama_Level == 'Mahasiswa') {
                                $('#tanda-pengenal').html(`
                                <td><strong>Kartu Tanda Pengenal</strong></td>
                                <td><strong>:</strong></td>
                                <td>
                                    <div style="width: 250px; height: 150px;"><img src="" alt="" class="w-100 h-100 object-fit-cover ratio-16x9 rounded-3 "></div>
                                </td>
                                    `);
                                $('#tanda-pengenal img').attr('src', `/public/assets/images/jaminan/${data.data.Jaminan}`);
                            } else {
                                $('#tanda-pengenal').html('');
                            }
                            const table = function ()  {
                                let html = '';
                                data.data.DetailTransaksi.forEach((detail) => {
                                    html += `
                                    <tr>
                                        <td>${detail.Inventaris.ID_Inventaris}</td>
                                        <td>${detail.Inventaris.Nama_Inventaris}</td>
                                        <td>${detail.Jumlah}</td>
                                        <td>${detail.Inventaris.Kategori.Nama_Kategori}</td>
                                    </tr>
                                    `;
                                })
                                return html;
                            }
                            $('.loan-detail-table tbody').html(table)
                            $('.modal-detail-container').removeClass('d-none');
                        })
                    },
                    error: (error) => {
                        $(document).ready(() => {
                            $('.peminjaman-modal-container-failed').removeClass('d-none');
                            $('#peminjaman-modal-container-failed-title').html('Gagal');
                            $('#peminjaman-modal-container-failed-message').html(`${error.responseText}`);
                        })
                    }
                })
        })
    })


    $(document).on('click', '.admin-retrieval-information', () => {
        $('.admin-retrieval-information').val('');
    })

    $('.button-save-loan').click(() => {
        const formData = new FormData(document.querySelector('#detail-peminjaman-form'));
        console.log(formData)
        $.ajax({
            url: '/admin/data-peminjaman/update',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                $(document).ready(() => {
                    $('.peminjaman-modal-container').removeClass('d-none');
                    $('#peminjaman-modal-container-title').html('Berhasil');
                    $('#peminjaman-modal-container-message').html('Penambahan Maintainer Berhasil Dilakukan');
                })
            },
            error: (error) => {
                $(document).ready(() => {
                    $('.peminjaman-modal-container-failed').removeClass('d-none');
                    $('#peminjaman-modal-container-failed-title').html('Gagal');
                    $('#peminjaman-modal-container-failed-message').html(`${error.responseText}`);
                })
            }
        })
    })

    $(document).on('click', '.button-back-loan', () => {
        $('.modal-detail-container').addClass('d-none');
    })
    $(document).on('click', '.peminjaman-failed-button-back', () => {
        $('.peminjaman-modal-container-failed').addClass('d-none');
    })
    $(document).on('click', '.peminjaman-success-button-back', () => {
        window.location.href = '/admin/data-peminjaman'
    })
</script>
