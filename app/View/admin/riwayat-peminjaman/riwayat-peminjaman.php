<div class="w-100 flex-grow-1 ">
  <div class="loans-content container-fluid py-4 d-flex justify-content-between">
    <strong class="loans-heading">Peminjaman Barang</strong>
    <div class="d-flex gap-2 position-relative">
      <div>
        <button class="loans-button-filter_sort btn-filter btn btn-light">Filter By<i data-feather="chevron-down" style="width: 1rem; height: 1rem"></i></button>
        <div class="filter-list bg-body-tertiary p-2 rounded position-absolute mt-1 d-none ">
          <ul class="d-flex flex-column gap-2">
            <li class="filter-list-item p-md-2 d-inline-block rounded-2">
              <a href="" class="text-decoration-none text-dark">Nama Barang</a>
            </li>
            <li class="filter-list-item p-md-2 d-inline-block rounded-2">
              <a href="" class="text-decoration-none text-dark">Kategori</a>
            </li>
            <li class="filter-list-item p-md-2 d-inline-block rounded-2">
              <a href="" class="text-decoration-none text-dark">Stok</a>
            </li>
          </ul>
        </div>
      </div>
      <div>
        <button class="loans-button-filter_sort btn-sort btn btn-light">Sort By<i data-feather="repeat" style="width: 1rem; height: 1rem; margin-left: 5px"></i></button>
        <div class="sort-list bg-body-tertiary p-2 rounded position-absolute mt-1 d-none  p-md-2">
          <ul style="list-style: none; padding: 0; margin: 0" class="d-flex flex-column gap-2">
            <li class="sort-list-item p-md-2 d-inline-block rounded-2">
              <a href="" class="text-decoration-none text-dark">Terkecil</a>
            </li>
            <li class="sort-list-item p-md-2 d-inline-block rounded-2">
              <a href="" class="sort-list-item text-decoration-none text-dark">Terbesar</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid h-100 flex-grow-1 overflow-hidden ">
  <div class="w-100 h-100 overflow-y-scroll ">
    <table class="history-table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Peminjam</th>
          <th>Status Peminjam</th>
          <th>Waktu Peminjaman</th>
          <th>Waktu Pengembalian</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>001</td>
          <td>Putra Zakaria Muzaki</td>
          <td>Mahasiswa</td>
          <td>Sept 20, 2023<br>11:00 AM</td>
          <td>Sept 20, 2023<br>11:00 AM</td>
          <td>
            <span class="rounded-2 " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.6rem 1rem; user-select: none;">Selesai</span>
          </td>
          <td><button class="button-detail-history btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
        </tr>
        <tr>
          <td>002</td>
          <td>Putra Zakaria Muzaki</td>
          <td>Dosen</td>
          <td>Sept 20, 2023<br>11:00 AM</td>
          <td>Sept 20, 2023<br>11:00 AM</td>
          <td>
            <span class="rounded-2 " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.6rem 1rem; user-select: none;">Selesai</span>
          </td>
          <td><button class="button-detail-history btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="modal-detail-container position-absolute w-100 h-100 bg-white d-flex flex-column justify-content-between d-none " style="color: #01305D;">
  <div class="w-100 text-center bg-warning p-2 rounded-2 ">
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
          <td><strong>Status Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td><strong>Disetujui</strong></td>
        </tr>
        <tr>
          <td><strong>Keterangan</strong></td>
          <td><strong>:</strong></td>
          <td><strong>Silahkan melakukan pengembalian di Ruang Admin Lt.7</strong></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="h-100 overflow-y-scroll">
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
</div>