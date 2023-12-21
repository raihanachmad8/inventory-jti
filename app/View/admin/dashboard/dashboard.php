<div class="dashboard-widget-admin p-4 pt-5 pt-lg-4  w-100" style=" color:#01305D">
  <div class="widget-item-admin flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between ">
    <div class="d-flex justify-content-between">
      <strong>Menunggu</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-menunggu.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1><?= $model['statusPeminjaman']['Menunggu'] ?></h1>
    </div>
    <div>
      <small>Total yang belum disetujui</small>
    </div>
  </div>
  <div class="widget-item-admin flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
    <div class="d-flex justify-content-between">
      <strong style="font-size: 1.2rem">Dikonfirmasi</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-dikonfirmasi.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1><?= $model['statusPeminjaman']['Diterima'] ?></h1>
    </div>
    <div>
      <small>Total barang yang siap diambil</small>
    </div>
  </div>
  <div class="widget-item-admin flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
    <div class="d-flex justify-content-between">
      <strong>Selesai</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-selesai.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1><?= ((int)$model['statusPeminjaman']['Selesai'] + (int) $model['statusPeminjaman']['Dibatalkan'] + (int) $model['statusPeminjaman']['Ditolak']) ?></h1>
    </div>
    <div>
      <small>Peminjaman yang sudah selesai</small>
    </div>
  </div>
  <div class="widget-item-admin flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
    <div class="d-flex justify-content-between">
      <strong>Belum Selesai</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-belum-selesai.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1><?= ((int)$model['statusPeminjaman']['Proses'] + (int) $model['statusPeminjaman']['Menunggu Ganti']) ?></h1>
    </div>
    <div>
      <small>Peminjaman yang belum selesai</small>
    </div>
  </div>
</div>

<div class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
  <div id="peminjaman-admin" class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="d-flex justify-content-between mb-2 ">
      <strong style="color:#01305D">Peminjaman</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-peminjaman.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="overflow-y-scroll h-100">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Tanggal<br>Peminjaman</th>
            <th>Tanggal<br>Pengembalian</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($model['peminjaman'])) : ?>
            <?php foreach ($model['peminjaman'] as $transaksi) : ?>
              <tr>
                <td><?= $transaksi->Pengguna->Nomor_Identitas ?></td>
                <td><?= $transaksi->Pengguna->Nama_Pengguna ?></td>
                <td><?= (new DateTime($transaksi->StartDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($transaksi->StartDate))->format('h:i A') ?></span></td>
                <td><?= (new DateTime($transaksi->EndDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($transaksi->EndDate))->format('h:i A') ?></span></td>
                <td><span class="rounded-2 mt-1 d-inline-block" style="color: <?php
                                                                              if ($transaksi->Status->Nama_Status == 'Selesai') {
                                                                                echo '#28A461';
                                                                              } elseif ($transaksi->Status->Nama_Status == 'Menunggu') {
                                                                                echo '#A45B18';
                                                                              } elseif ($transaksi->Status->Nama_Status == "Proses") {
                                                                                echo '#C58208';
                                                                              } elseif ($transaksi->Status->Nama_Status == 'Diterima') {
                                                                                echo '#074B81';
                                                                              } else {
                                                                                echo '#960000';
                                                                              } ?>;background-color: <?php
                                                                                                      if ($transaksi->Status->Nama_Status == 'Selesai') {
                                                                                                        echo 'rgba(40, 164, 97, 0.15)';
                                                                                                      } elseif ($transaksi->Status->Nama_Status == 'Menunggu') {
                                                                                                        echo 'rgba(218, 114, 19, 0.15)';
                                                                                                      } elseif ($transaksi->Status->Nama_Status == "Proses") {
                                                                                                        echo '#FFF9E1';
                                                                                                      } elseif ($transaksi->Status->Nama_Status == 'Diterima') {
                                                                                                        echo 'rgba(158, 214, 251, 0.65)';
                                                                                                      } else {
                                                                                                        echo 'rgba(252, 64, 86, 0.30)';
                                                                                                      } ?>; padding: 0.3rem 1rem; user-select: none;"><?= $transaksi->Status->Nama_Status ?></span></td>
                <td><button class="loan--details-button--approval btn" style="background-color: #CEE7FF; color:#01305D;" data-kode="<?= $transaksi->ID_Transaksi ?>">Detail</button></td>
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

<div class="modal-detail-container position-fixed top-0 start-0 vw-100 vh-100 bg-white d-flex flex-column justify-content-between overflow-y-scroll  d-none" style="color: #01305D;">
  <form id="detail-pengembalian-form">
    <div class="w-100 text-center bg-warning p-2 rounded-2 ">
      <strong class="text-white">Detail Peminjaman</strong>
    </div>
    <div class="pt-4 ">
      <table class="identity-table">

        <input type="hidden" name="kode">
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
              <select class="form-select" id="maintainer-admin" aria-label="Default select example" name="maintainer" style="max-width: 200px;">
                <?php foreach ($model['maintainer'] as $maintainer) : ?>
                  <option value="<?= $maintainer->ID_Maintainer ?>"><?= $maintainer->Nama_Maintainer ?></option>
                <?php endforeach; ?>
              </select>
            </td>
          </tr>
          <tr>
            <td><strong>Status Peminjaman</strong></td>
            <td><strong>:</strong></td>
            <td>
              <select class="form-select" id="status" aria-label="Default select example" name="status" style="max-width: 200px;">
                <?php foreach ($model['status'] as $status) : ?>
                  <option value="<?= $status->ID_Status ?>"><?= $status->Nama_Status ?></option>
                <?php endforeach; ?>
              </select>
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
            <td><textarea class="admin-retrieval-information p-2 rounded-2 border border-light-subtle" name="pesan" id="" cols="30" rows="1" type="text">Silahkan melakukan pengambilan barang di ruang teknisi Lantai 7</textarea></td>
          </tr>
          <tr>
            <td><strong>Alasan Peminjaman</strong></td>
            <td><strong>:</strong></td>
            <td>
              <p id="deskripsi-keperluan"></p>
            </td>
          </tr>
          <tr id="tanda-pengenal">

          </tr>
        </tbody>

      </table>
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
      <button class="button-save-loan btn text-white" style="background-color: #FFB733">Simpan</button>
    </div>
  </form>
</div>

<script>
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
            $('#detail-pengembalian-form').trigger('reset');
            $('input[name="kode"]').val(data.data.ID_Transaksi);
            $('#status-peminjam').html(data.data.Pengguna.Level.Nama_Level);
            $('#nama').html(data.data.Pengguna.Nama_Pengguna);
            if (data.data.Admin != null) {
              $('#admin').html(data.data.Admin.ID_Maintainer);
            }
            $('#status').val(data.data.Status.ID_Status);
            $('#nomor-identitas').html(data.data.Pengguna.Nomor_Identitas);
            $('#start-date').html(new Date(data.data.StartDate).toLocaleDateString("id-ID", options));
            $('#end-date').html(new Date(data.data.EndDate).toLocaleDateString("id-ID", options));
            if (data.data.Deskripsi_Keperluan !== "undefined") {
              $('#deskripsi-keperluan').html(data.data.Deskripsi_Keperluan);
            } else {
              $('#deskripsi-keperluan').html('-');
            }
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
            const table = function() {
              let html = '';
              data.data.DetailTransaksi.forEach((detail) => {
                html += `
                                    <tr>
                                        <input type="hidden" name="id_detail[]" value="${detail.ID_DetailTrc}">
                                        <td>${detail.Inventaris.ID_Inventaris}</td>
                                        <td>${detail.Inventaris.Nama_Inventaris}</td>
                                        <td>${detail.Jumlah}</td>
                                        <td>${detail.Inventaris.Kategori.Nama_Kategori}</td>
                                        <td class="d-flex justify-content-center">
                                            <select class="form-select" aria-label="Default select example" id="kondisi" name="kondisi[]" style="max-width: 120px;">
                                                <option value="Normal">Normal</option>
                                                <option value="Rusak">Rusak</option>
                                                <option value="Hilang">Hilang</option>
                                            </select>
                                        </td>
                                    </tr>
                                    `;
              })
              return html;
            }
            $('.loan-detail-table tbody').html(table)
            document.querySelectorAll('#kondisi').forEach((kondisi, i) => {
              kondisi.value = data.data.DetailTransaksi[i].Kondisi;
            })
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
      })
    })
  })


  $(document).on('click', '.admin-retrieval-information', () => {
    $('.admin-retrieval-information').val('');
  })

  $('.button-save-loan').click((e) => {
    console.log('clicked')
    const formData = new FormData(document.querySelector('#detail-pengembalian-form'));
    e.preventDefault();
    $.ajax({
      url: '/admin/data-peminjaman/update',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
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

  $('.button-back-loan').click(() => {
    $('.modal-detail-container').addClass('d-none');
  })
</script>