<div class="container-fluid pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
  <div class="w-100 d-flex flex-column flex-md-row row-gap-3  justify-content-between ">
    <h1 class="loans-heading">Riwayat Peminjaman</h1>
    <div class="h-100 d-flex justify-content-between column-gap-4 ">
      <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3">
        <input type="text" placeholder="Cari" class="w-100 h-100 px-3 rounded-3" style="border: none; outline: none;">
        <div class="position-absolute bg-white" style="width: 1.7rem; height: 1.7rem; right: 0.7rem;">
          <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="overflow-y-scroll h-100">
      <table class="history-table">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Peminjam</th>
            <th>Status Peminjam</th>
            <th>Waktu Peminjaman</th>
            <th>Waktu Pengembalian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>001</td>
            <td>Putra Zakaria Muzaki</td>
            <td>Mahasiswa</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td><button class="button-detail-history btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>001</td>
            <td>Putra Zakaria Muzaki</td>
            <td>Dosen</td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
            </td>
            <td><button class="button-detail-history btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal-detail-history-container position-absolute px-4  w-100 h-100 bg-white d-flex flex-column justify-content-between overflow-y-scroll d-none " style="color: #01305D;">
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
            <p>Pak Putra</p>
          </td>
        </tr>
        <tr>
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <p>Selesai</p>
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
          <td>
            <p>Silahkan melakukan pengambilan barang di ruang teknisi Lantai 7</p>
          </td>
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
    <button class="button-back-loan-history btn text-white" style="background-color: #01305D;">Kembali</button>
  </div>
</div>