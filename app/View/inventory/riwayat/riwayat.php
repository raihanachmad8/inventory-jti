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
          <tr>
            <td>001</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>
              <span class="rounded-2 " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.6rem 1rem; user-select: none;">Selesai</span>
            </td>
            <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>001</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>
              <span class="rounded-2 " style="color: #960000;background-color: rgba(252, 64, 86, 0.30); padding: 0.6rem 1rem; user-select: none;">Dibatalkan</span>
            </td>
            <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>001</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>
              <span class="rounded-2 " style="color: #C58208;background-color: #FFF9E1; padding: 0.6rem 1rem; user-select: none;">Proses</span>
            </td>
            <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>001</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>
              <span class="rounded-2 " style="color: #A45B18; background-color: rgba(218, 114, 19, 0.30); padding: 0.6rem 1rem; user-select: none;">Menunggu</span>
            </td>
            <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>001</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>
              <span class="rounded-2 " style="color: #074B81;background-color: rgba(158, 214, 251, 0.65); padding: 0.6rem 1rem; user-select: none;">Diterima</span>
            </td>
            <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
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
          <td>Putra Zakaria Muzaki</td>
        </tr>
        <tr>
          <td><strong>Nomor ID</strong></td>
          <td><strong>:</strong></td>
          <td>23946238947</td>
        </tr>
        <tr>
          <td><strong>Status Peminjam</strong></td>
          <td><strong>:</strong></td>
          <td>Mahasiswa</td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>Menunggu</td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td></td>
        </tr>
        <tr>
          <td><strong>Alasan Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            Kiw kepo banget>
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
    <button class="button-cancel-loan btn btn-danger text-white">Batalkan</button>
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