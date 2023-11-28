<div class="loan-main h-100 overflow-y-scroll">
  <div class="loans-content container-fluid py-4 d-flex justify-content-between">
    <strong class="loans-heading">Peminjaman Barang</strong>
    <div class="d-flex gap-2 position-relative">
      <div>
        <button class="loans-button-filter_sort btn-filter btn btn-light">Filter By<i data-feather="chevron-down" style="width: 1rem; height: 1rem"></i></button>
        <div class="filter-list bg-body-tertiary p-2 rounded position-absolute mt-1 hidden">
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
        <div class="sort-list bg-body-tertiary p-2 rounded position-absolute mt-1 hidden p-md-2">
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
  <div class="inventory-items-container container-fluid d-flex gap-3 flex-wrap h-100">
    <div class="inventory-item d-flex flex-column bg-body-tertiary p-2 gap-2 p-xl-3">
      <div class="flex-grow-1">
        <img src="./public/assets/images/jay-zhang-ZByWaPXD2fU-unsplash.jpg" alt="" class="w-100 object-fit-cover h-100 ratio-1x1 rounded-2" />
      </div>
      <div class="text-dark flex-grow-1">
        <div class="d-flex justify-content-between">
          <div class="inventory-item-name-data flex-grow-1 d-flex flex-column">
            <strong>Keyboard</strong>
            <strong class="text-body-tertiary">Mas Awun</strong>
          </div>
          <div class="inventory-item-qty-data flex-grow-1 d-flex align-items-center justify-content-center justify-content-md-end">
            <strong>20/20</strong>
          </div>
        </div>
      </div>
      <div class="inventory-item-button-container w-100 d-flex justify-content-between align-items-center">
        <div class="counter-container w-100 d-flex justify-content-between d-none">
          <label for="pinjam" class="btn-counter btn-counter-min btn btn-primary">-</label>
          <input id="pinjam" type="text" class="counter-input w-50 rounded bg-dark-subtle" />
          <label for="pinjam" class="btn-counter btn-counter-plus btn btn-primary">+</label>
        </div>
        <button class="inventory-item-button btn btn-primary w-100" type="button">Pinjam</button>
      </div>
    </div>
    <div class="inventory-item d-flex flex-column bg-body-tertiary p-2 gap-2 p-xl-3">
      <div class="flex-grow-1">
        <img src="./public/assets/images/jay-zhang-ZByWaPXD2fU-unsplash.jpg" alt="" class="w-100 object-fit-cover h-100 ratio-1x1 rounded-2" />
      </div>
      <div class="text-dark flex-grow-1">
        <div class="d-flex justify-content-between">
          <div class="inventory-item-name-data flex-grow-1 d-flex flex-column">
            <strong>Keyboard</strong>
            <strong class="text-body-tertiary">Mas Awun</strong>
          </div>
          <div class="inventory-item-qty-data flex-grow-1 d-flex align-items-center justify-content-center justify-content-md-end">
            <strong>20/20</strong>
          </div>
        </div>
      </div>
      <div class="inventory-item-button-container w-100 d-flex justify-content-between align-items-center">
        <div class="counter-container w-100 d-flex justify-content-between d-none">
          <label for="pinjam" class="btn-counter btn-counter-min btn btn-primary">-</label>
          <input id="pinjam" type="text" class="counter-input w-50 rounded bg-dark-subtle" />
          <label for="pinjam" class="btn-counter btn-counter-plus btn btn-primary">+</label>
        </div>
        <button class="inventory-item-button btn btn-primary w-100" type="button">Pinjam</button>
      </div>
    </div>
  </div>
</div>
<div class="loan-button-container w-100 py-3 px-3 bg-body-tertiary">
  <button class="loan-button btn btn-primary w-100" type="button" disabled>Pinjam(0)</button>
</div>
<div class="confirmation-modal-container container-fluid position-absolute h-100 bg-white overflow-y-scroll d-none">
  <div class="pb-3 d-flex justify-content-between ">
    <strong>
      <h1>Konfirmasi Peminjaman</h1>
    </strong>
    <button type="button" class="confirmation-modal-close btn"><i data-feather="x"></i></button>
  </div>
  <div>
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
          <td><strong>53284985165</strong></td>
        </tr>
        <tr>
          <td><strong>Tanggal Peminjaman</strong></td>
          <td><strong>:</strong></td>
          <td>
            <button class="date-modal-button btn-sm btn btn-primary">DD//MM//YYYY</button>
          </td>
        </tr>
        <tr>
          <td><strong>Tanggal Kembali</strong></td>
          <td><strong>:</strong></td>
          <td>
            <button class="date-modal-button btn-sm btn btn-primary">DD//MM//YYYY</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="inventory-loans-table-container text-center">
    <table class="inventory-loans-table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Jumlah</th>
          <th>Kategori</th>
          <th>Tanggal<br>Peminjaman</th>
          <th>Tanggal<br>Pengembalian</th>
          <th>Pinjam</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>001</td>
          <td>Keyboard</td>
          <td>1</td>
          <td>Keyboard</td>
          <td>DD//MM//YYYY</td>
          <td>DD//MM//YYYY</td>
          <td>
            <form action="" class="form-choose"><input type="checkbox" name="" id="" class="form-choose-input-loan form-choose-input-loan-non-active" style="cursor: pointer;"></form>
          </td>
        </tr>
        <tr>
          <td>001</td>
          <td>Keyboard</td>
          <td>1</td>
          <td>Keyboard</td>
          <td>DD//MM//YYYY</td>
          <td>DD//MM//YYYY</td>
          <td>
            <form action="" class="form-choose"><input type="checkbox" name="" id="" class="form-choose-input-loan form-choose-input-loan-non-active" style="cursor: pointer;"></form>
          </td>
        </tr>
        <tr>
          <td>001</td>
          <td>Keyboard</td>
          <td>1</td>
          <td>Keyboard</td>
          <td>DD//MM//YYYY</td>
          <td>DD//MM//YYYY</td>
          <td>
            <form action="" class="form-choose"><input type="checkbox" name="" id="" class="form-choose-input-loan form-choose-input-loan-non-active" style="cursor: pointer;"></form>
          </td>
        </tr>
        <tr>
          <td>001</td>
          <td>Keyboard</td>
          <td>1</td>
          <td>Keyboard</td>
          <td>DD//MM//YYYY</td>
          <td>DD//MM//YYYY</td>
          <td>
            <form action="" class="form-choose"><input type="checkbox" name="" id="" class="form-choose-input-loan form-choose-input-loan-non-active" style="cursor: pointer;"></form>
          </td>
        </tr>
        <tr>
          <td>001</td>
          <td>Keyboard</td>
          <td>1</td>
          <td>Keyboard</td>
          <td>DD//MM//YYYY</td>
          <td>DD//MM//YYYY</td>
          <td>
            <form action="" class="form-choose"><input type="checkbox" name="" id="" class="form-choose-input-loan form-choose-input-loan-non-active" style="cursor: pointer;"></form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="py-4 d-flex row-gap-3 flex-column ">
    <strong>
      <h3>Upload Bukti Peminjaman</h3>
    </strong>
    <label for="image" class="d-flex justify-content-center align-items-center border rounded-3 w-100 " style="height: 200px; cursor: pointer;"><i data-feather="image" style="width: 3rem; height:3rem; " class="text-body-tertiary"></i></label>
    <input id="image" type="file" class="d-none">
  </div>
  <div class="pb-4 ">
    <strong>
      <h3>Alasan Peminjaman</h3>
    </strong>
    <textarea name="" id="" cols="30" rows="10" class="w-100 border rounded-3 p-2 "></textarea>
  </div>
  <div class="d-flex justify-content-end pb-5 pt-2 ">
    <button class="btn btn-success w-100 " type="submit">Submit</button>
  </div>
  <div class="calendar-modal-container position-fixed vw-100 vh-100 d-flex justify-content-center align-items-center d-none ">
    <div class="calendar-container-inner rounded-5 bg-light-subtle d-flex flex-column p-4 ">
      <div class="d-flex justify-content-between ">
        <h5>Pilih Waktu</h5>
        <button class="date-modal-close btn"><i data-feather="x"></i></button>
      </div>
      <hr>
      <h5>28-November-2023 22:56</h5>
      <div class="calendar-body-container w-100 h-100 d-flex">
        <div class="calendar flex-grow-1  text-center container-fluid py-3  rounded-3 h-100 d-flex flex-column h-100 justify-content-center row-gap-2 ">
          <div class="text-center bg-body-secondary p-1 rounded-3 d-flex justify-content-center align-items-center">
            <strong class="calendar-month" style="font-size: 1.5rem"></strong>
          </div>
          <div class="calendar-week">
            <div class="col">Sun</div>
            <div class="col">Mon</div>
            <div class="col">Tue</div>
            <div class="col">Wed</div>
            <div class="col">Thu</div>
            <div class="col">Fri</div>
            <div class="col">Sat</div>
          </div>
          <div class="calendar-days">
            <div class="col">1</div>
            <div class="col">2</div>
            <div class="col">3</div>
            <div class="col">4</div>
            <div class="col">5</div>
            <div class="col">6</div>
            <div class="col">7</div>
            <div class="col">8</div>
            <div class="col">9</div>
            <div class="col">10</div>
            <div class="col">11</div>
            <div class="col">12</div>
            <div class="col">13</div>
            <div class="col">14</div>
            <div class="col">15</div>
            <div class="col">16</div>
            <div class="col">17</div>
            <div class="col">18</div>
            <div class="col">19</div>
            <div class="col">20</div>
            <div class="col">21</div>
            <div class="col">22</div>
            <div class="col">23</div>
            <div class="col">24</div>
            <div class="col">25</div>
            <div class="col">26</div>
            <div class="col">27</div>
            <div class="col">28</div>
          </div>
        </div>
        <div class="flex-grow-1 w-75 h-100 d-flex justify-content-evenly  align-items-center">
          <div class="d-flex flex-column justify-content-center align-items-center ">
            <button class="btn">
              <i data-feather="chevron-up"></i>
            </button>
            <strong style="font-size: 3rem">00</strong>
            <button class="btn">
              <i data-feather="chevron-down"></i>
            </button>
          </div>
          <strong style="font-size: 3rem;">:</strong>
          <div class="d-flex flex-column justify-content-center align-items-center ">
            <button class="btn">
              <i data-feather="chevron-up"></i>
            </button>
            <strong style="font-size: 3rem">00</strong>
            <button class="btn">
              <i data-feather="chevron-down"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="w-100 d-flex justify-content-end">
        <div class="w-50 d-flex column-gap-2 justify-content-end ">
          <button class="btn btn-success w-50">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>