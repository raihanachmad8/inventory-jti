<div class="gap-4 p-3 d-flex" style=" color:#01305D">
  <div class="flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between " style="width: 5rem; height: 11rem; color:#01305D">
    <div class="d-flex justify-content-between">
      <strong style="font-size: 1.2rem;">Menunggu</strong>
      <div style="width: 1.7rem; height: 1.7rem">
        <img src="./public/assets/images/icon-menunggu.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1>0</h1>
    </div>
    <div>
      <small>Total yang belum disetujui</small>
    </div>
  </div>
  <div class="flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center" style="width: 5rem; height: 11rem;">
    <div class="d-flex justify-content-between">
      <strong style="font-size: 1.2rem">Dikonfirmasi</strong>
      <div style="width: 1.7rem; height: 1.7rem">
        <img src="./public/assets/images/icon-dikonfirmasi.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1>0</h1>
    </div>
    <div>
      <small>Total barang yang siap diambil</small>
    </div>
  </div>
  <div class="flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center" style="width: 5rem; height: 11rem;">
    <div class="d-flex justify-content-between">
      <strong style="font-size: 1.2rem;">Selesai</strong>
      <div style="width: 1.7rem; height: 1.7rem">
        <img src="./public/assets/images/icon-selesai.svg" alt="" class="h-100  w-100 object-fit-cover">
      </div>
    </div>
    <div class="text-center">
      <h1>0</h1>
    </div>
    <div>
      <small>Peminjaman yang sudah selesai</small>
    </div>
  </div>
  <div class="flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center" style="width: 5rem; height: 11rem;">
    <div class="d-flex justify-content-between">
      <strong style="font-size: 1.2rem;">Belum Selesai</strong>
      <div style="width: 1.7rem; height: 1.7rem">
        <img src="./public/assets/images/icon-belum-selesai.svg" alt="" class="h-100  w-100 object-fit-cover">
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
<div class="m-auto gap-4 d-flex overflow-hidden pb-3 px-3 rounded-4 w-100 h-100">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="d-flex justify-content-between p-2 ">
      <strong style="font-size: 2rem; color:#01305D">Peminjaman</strong>
      <div style="width: 2.5rem; height: 2.5rem">
        <img src="./public/assets/images/icon-peminjaman.svg" alt="" class="h-100  w-100 object-fit-cover">
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
            <td>Nov, 17 2023<br><span style="display: inline-block; padding: 0.5rem 1rem; background-color: #FFF9E1; color: #19663D;" class="rounded-2">11:45 AM</span></td>
            <td>Nov, 17 2023<br><span style="display: inline-block; padding: 0.5rem 1rem; background-color: #FFF9E1; color: #19663D;" class="rounded-2">11:45 AM</span></td>
            <td><button class="loan--details-button--approval btn text-white" style="background-color: #0A60A4;">Detail</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal-detail-container position-absolute w-100 h-100 bg-white d-flex flex-column justify-content-between overflow-y-scroll d-none " style="color: #01305D;">
  <div class="w-100 text-center bg-warning p-1 rounded-2 ">
    <h2><strong class="text-white">Detail Peminjaman</strong></h2>
  </div>
  <div class="pt-4 ">
    <table class="identity-table">
      <tbody>
        <tr>
          <td><strong>Nama</strong></td>
          <td><strong>:</strong></td>
          <td><strong>Putra Zakaria Muzaki</strong></td>
        </tr>
        <tr>
          <td><strong>Nomor ID</strong></td>
          <td><strong>:</strong></td>
          <td><strong>23946238947</strong></td>
        </tr>
        <tr>
          <td><strong>Status Peminjam</strong></td>
          <td><strong>:</strong></td>
          <td><strong>Mahasiswa</strong></td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td><strong>Menunggu Persetujuan</strong></td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td><textarea class="admin-retrieval-information" name="" id="" cols="30" rows="1" type="text">Silahkan melakukan pengambilan barang di ruang teknisi Lantai 7</textarea></td>
        </tr>
        <tr>
          <td><strong>Alasan Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <strong>Kiw kepo banget</strong>
          </td>
        </tr>
        <tr>
          <td><strong>Kartu Tanda Pengenal</strong></td>
          <td><strong>:</strong></td>
          <td>
            <div style="width: 30rem; height: 15rem;"><img src="./public/assets/images/anggap-aja-ktm.jpg" alt="" class="w-100 h-100 object-fit-cover ratio-16x9 rounded-3 "></div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="h-100">
    <strong>
      <h5><strong>Daftar Pengembalian</strong></h5>
    </strong>
    <div class="w-100 ">
      <table class="loan-detail-table w-100 text-center ">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Tanggal<br>Peminjaman</th>
            <th>Tanggal<br>Pengembalian</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1001</td>
            <td>Kursi</td>
            <td>5</td>
            <td>Barang</td>
            <td>2023-November-2023<br>13:00:00</td>
            <td>2023-November-2023<br>13:00:00</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="py-4 d-flex justify-content-end column-gap-3 ">
    <button class="button-reject-loan btn btn-danger">Tolak</button>
    <button class="button-approve-loan btn btn-success">Setujui</button>
  </div>
</div>