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
<div class="m-auto gap-4 d-flex overflow-hidden pb-3 px-3 rounded-4 w-100 h-100">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="overflow-y-scroll h-100">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Status Peminjam</th>
            <th>Tanggal<br>Peminjaman</th>
            <th>Tanggal<br>Pengembalian</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>0000011</td>
            <td>Putra Zakaria Muzaki</td>
            <td>Mahasiswa</td>
            <td>Nov, 17 2023<br><span style="display: inline-block; padding: 0.5rem 1rem; background-color: #FFF9E1; color: #19663D;" class="rounded-2">11:45 AM</span></td>
            <td>Nov, 17 2023<br><span style="display: inline-block; padding: 0.5rem 1rem; background-color: #FFF9E1; color: #19663D;" class="rounded-2">11:45 AM</span></td>
            <td><button class="loan--details-button--approval btn text-white" style="background-color: #0A60A4;">Detail</button></td>
          </tr>
          <tr>
            <td>0000011</td>
            <td>Putra Zakaria Muzaki</td>
            <td>Dosen</td>
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
            <div style="width: 30rem; height: 15rem;"><img src="/public/assets/images/anggap-aja-ktm.jpg" alt="" class="w-100 h-100 object-fit-cover ratio-16x9 rounded-3 "></div>
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
    <button class="button-reject-loan btn text-white" style="background-color: #01305D;">Kembali</button>
    <button class="button-approve-loan btn text-white " style="background-color: #FFB733">Simpan</button>
  </div>
</div>