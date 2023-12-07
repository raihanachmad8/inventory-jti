
<div class="dashboard-widget-admin p-4 w-100" style=" color:#01305D">
  <div class="widget-item-admin flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between ">
    <div class="d-flex justify-content-between">
      <strong>Menunggu</strong>
      <div class="widget-icon">
        <img src="/public/assets/images/icon-menunggu.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1>0</h1>
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
      <h1>0</h1>
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
      <h1>0</h1>
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
      <h1>0</h1>
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>0000011</td>
            <td>Putra Zakaria Muzaki</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            <td><button class="loan--details-button--approval btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
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
    <table class="identity-table">
      <tbody>
        <tr>
          <td><strong>Jenis Peminjam</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p>Mahasiswa</p>
          </td>
        </tr>
        <tr>
          <td><strong>Nama</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p>Putra Zakaria Muzaki</p>
          </td>
        </tr>
        <tr>
          <td><strong>Nomor ID</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p>23946238947</p>
          </td>
        </tr>
        <tr>
          <td><strong>Admin</strong></td>
          <td><strong>:</strong></td>
          <td>
            <select class="form-select" aria-label="Default select example" style="max-width: 200px;">
              <option value="putra">Pak Putra</option>
              <option value="raihan">Pak Raihan</option>
              <option value="dela">Bu Dela</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <select class="form-select" aria-label="Default select example" style="max-width: 200px;">
              <option value="menunggu">Menunggu</option>
              <option value="disetujui">Disetujui</option>
              <option value="ditolak">Ditolak</option>
              <option value="proses">Proses</option>
              <option value="selesai">Selesai</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><strong>Tanggal Peminjaman</strong></td>
          <td>:</td>
          <td>
            <p>17 Agustus 2023 12:00:00</p>
          </td>
        </tr>
        <tr>
          <td><strong>Waktu Pengembalian</strong></td>
          <td>:</td>
          <td>
            <p>17 Agustus 2023 12:00:00</p>
          </td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td><textarea class="admin-retrieval-information p-2 rounded-2 border border-light-subtle" name="" id="" cols="30" rows="1" type="text">Silahkan melakukan pengambilan barang di ruang teknisi Lantai 7</textarea></td>
        </tr>
        <tr>
          <td><strong>Alasan Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p>Kiw kepo banget</p>
          </td>
        </tr>
        <tr>
          <td><strong>Kartu Tanda Pengenal</strong></td>
          <td><strong>:</strong></td>
          <td>
            <div style="width: 250px; height: 150px;"><img src="/public/assets/images/anggap-aja-ktm.jpg" alt="" class="w-100 h-100 object-fit-cover ratio-16x9 rounded-3 "></div>
          </td>
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
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1001</td>
            <td>Kursi</td>
            <td>5</td>
            <td>Barang</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="py-4 d-flex justify-content-end column-gap-3 ">
    <button class="button-back-loan btn text-white" style="background-color: #01305D;">Kembali</button>
    <button class="button-save-loan btn text-white " style="background-color: #FFB733">Simpan</button>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-save-edit-loan-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p>Data berhasil diubah</p>
    </div>
    <div>
      <button class="btn text-white success-save-edit-loan-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>