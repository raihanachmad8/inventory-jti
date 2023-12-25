<div class="container-fluid p-4 w-100 d-flex flex-column row-gap-3">
  <div class="w-100 d-flex justify-content-between">
    <h1 class="loans-heading">Riwayat Peminjaman</h1>
  </div>
</div>

<div class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="overflow-y-scroll h-100">
      <table class="history-table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($model['riwayat']) > 0) : ?>
            <?php foreach ($model['riwayat'] as $riwayat) : ?>
              <tr>
                <td><?= $riwayat->ID_Transaksi ?></td>
                <td><?= (new DateTime($riwayat->StartDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($riwayat->StartDate))->format('h:i A') ?></span></td>
                <td><?= (new DateTime($riwayat->EndDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($riwayat->EndDate))->format('h:i A') ?></span></td>
                <td><span class="rounded-2 mt-1 d-inline-block" style="color: <?php
                                                                              if ($riwayat->Status->Nama_Status == 'Selesai') {
                                                                                echo '#28A461';
                                                                              } elseif ($riwayat->Status->Nama_Status == 'Menunggu') {
                                                                                echo '#A45B18';
                                                                              } elseif ($riwayat->Status->Nama_Status == "Proses") {
                                                                                echo '#C58208';
                                                                              } elseif ($riwayat->Status->Nama_Status == 'Diterima') {
                                                                                echo '#074B81';
                                                                              } else {
                                                                                echo '#960000';
                                                                              } ?>;background-color: <?php
                                                                                                      if ($riwayat->Status->Nama_Status == 'Selesai') {
                                                                                                        echo 'rgba(40, 164, 97, 0.15)';
                                                                                                      } elseif ($riwayat->Status->Nama_Status == 'Menunggu') {
                                                                                                        echo 'rgba(218, 114, 19, 0.15)';
                                                                                                      } elseif ($riwayat->Status->Nama_Status == "Proses") {
                                                                                                        echo '#FFF9E1';
                                                                                                      } elseif ($riwayat->Status->Nama_Status == 'Diterima') {
                                                                                                        echo 'rgba(158, 214, 251, 0.65)';
                                                                                                      } else {
                                                                                                        echo 'rgba(252, 64, 86, 0.30)';
                                                                                                      } ?>; padding: 0.3rem 1rem; user-select: none;"><?= $riwayat->Status->Nama_Status ?></span></td>
                <td><button class="button-detail-history-loan btn" data-kode="<?= $riwayat->ID_Transaksi ?>" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
              </tr>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td colspan="5" class="text-center">Tidak ada riwayat peminjaman</td>
            </tr>
          <?php endif; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal-detail-container px-4 position-absolute w-100 h-100 bg-white d-flex flex-column justify-content-between overflow-y-scroll z-2 d-none" style="color: #01305D;">
  <div class="w-100 text-center bg-warning p-2 rounded-2 ">
    <strong class="text-white">Detail Peminjaman</strong>
  </div>
  <div class="pt-4 identity-table-container">
    <table class="identity-table">
      <tbody>
        <tr>
          <td><strong>Nama</strong></td>
          <td><strong>:</strong></td>
          <td id="nama">Putra Zakaria Muzaki</td>
        </tr>
        <tr>
          <td><strong>Nomor ID</strong></td>
          <td><strong>:</strong></td>
          <td id="nomor-identitas">23946238947</td>
        </tr>
        <tr>
          <td><strong>Status Peminjam</strong></td>
          <td><strong>:</strong></td>
          <td id="status-peminjam">Mahasiswa</td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td id="status">Menunggu</td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td id="keterangan"></td>
        </tr>
        <tr>
          <td><strong>Alasan Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td id="deskripsi-keperluan">
          </td>
        </tr>
        <tr id="tanda-pengenal">
        </tr>
      </tbody>
    </table>
  </div>
  <div class="h-100">
    <strong>
      <h5><strong>Daftar Barang</strong></h5>
    </strong>
    <div class="w-100 mt-2 ">
      <table class="loan-detail-table w-100 text-center ">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Kondisi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="py-4 d-flex justify-content-end column-gap-3 ">
    <button class="button-back-loan btn text-white" style="background-color: #01305D;">Kembali</button>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="cancel-loan-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="delete-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
    <div class="d-flex flex-column align-items-center ">
      <img src="/public/assets/images/batalkan.svg" alt="">
      <h3 style="color: #CC3333;">
        <strong>
          Batalkan Peminjaman
        </strong>
      </h3>
    </div>
    <div>
      <p class="text-center">Apakah Anda yakin ingin membatalkan Peminjaman ini?</p>
    </div>
    <div class="d-flex gap-3 w-100 justify-content-evenly ">
      <button class="btn text-white delete-item-button-back" style="background-color: #01305D; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
      <button class="btn btn-danger cancel-loan-button"><strong>Batalkan</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-cancel-loan-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p class="text-center">Peminjaman berhasil dibatalkan</p>
    </div>
    <div>
      <button class="btn text-white cancel-loan-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

<script>
  $('.button-detail-history-loan').each(function() {
    $(this).click(async function() {
      const kode = $(this).data('kode');
      await $.ajax({
        url: '/inventory/historyPeminjaman',
        method: 'GET',
        data: {
          kode: kode
        },
        dataType: 'json',
        success: function(data) {
          $(document).ready(() => {
            const options = {
              year: "numeric",
              month: "long",
              day: "numeric",
              hour: "numeric",
              minute: "numeric",
              hour12: false, // Use 24-hour format
            };
            $('#nama').html(data.data.Pengguna.Nama_Pengguna);
            $('#nomor-identitas').html(data.data.Pengguna.Nomor_Identitas);
            $('#status-peminjam').html(data.data.Pengguna.Level.Nama_Level);
            $('#status').html(data.data.Status.Nama_Status);
            if (data.data.Status.Nama_Status == "Menunggu") {
              $('.detail-loan-button').append(`<button class="button-cancel-loan btn btn-danger text-white">Batalkan</button>`);
            }
            $('#keterangan').html(data.data.Pesan);
            $('#deskripsi-keperluan').html(data.data.Deskripsi_Keperluan);
            $('#start-date').html(new Date(data.data.StartDate).toLocaleDateString("id-ID", options));
            $('#end-date').html(new Date(data.data.EndDate).toLocaleDateString("id-ID", options));
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
            const table = function() {
              let html = '';
              data.data.DetailTransaksi.forEach((detail) => {
                html += `
                                    <tr>
                                        <td>${detail.Inventaris.ID_Inventaris}</td>
                                        <td>${detail.Inventaris.Nama_Inventaris}</td>
                                        <td>${detail.Jumlah}</td>
                                        <td>${detail.Inventaris.Kategori.Nama_Kategori}</td>
                                        <td>${detail.Kondisi}</td>
                                    </tr>
                                    `;
              })
              return html;
            }
            $('.loan-detail-table tbody').html(table)
            $('.cancel-loan-button').attr('data-kode', data.data.ID_Transaksi);
            $('.content').addClass('d-none')
            $('.modal-detail-container').removeClass('d-none');
          })

        },
        error: (error) => {
          $(document).ready(function() {
            $('.modal-container-failed').removeClass('d-none');
            $('#modal-container-failed-title').html('Gagal');
            $('#modal-container-failed-message').html(error.responseJSON.error);

          })
        }
      });
    })
  })

  $('.cancel-loan-button').click(function(e) {
    e.preventDefault();
    const kode = $(this).data('kode');
    $.ajax({
      url: `/inventory/history/delete?kode=${kode}`,
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

  $(document).on('click', '.button-back-loan ', () => {
    $('.content').removeClass('d-none')
    $('.modal-detail-container').addClass('d-none');
  })
  $(document).on('click', '.delete-item-button-back ', () => {
    $('.cancel-loan-modal-container').addClass('d-none');
  })
  $(document).on('click', '.button-cancel-loan ', () => {
    $('.cancel-loan-modal-container').removeClass('d-none');
  })
</script>