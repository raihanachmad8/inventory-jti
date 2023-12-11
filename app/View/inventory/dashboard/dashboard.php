    
    <div class="gap-4 p-4 pt-5 pt-lg-4  d-flex flex-column flex-md-row w-100" style=" color:#01305D">
      <div class="dashboard-widget-item flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between ">
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
      <div class="dashboard-widget-item flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
        <div class="d-flex justify-content-between">
          <strong>Dikonfirmasi</strong>
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
      <div class="dashboard-widget-item flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
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
      <div class="dashboard-widget-item flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between align-content-center">
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

    <div class="content m-auto gap-4 d-flex flex-lg-row flex-column overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
      <div id="peminjaman" class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden w-100">
        <div class="d-flex justify-content-between">
          <strong style="color:#01305D">Peminjaman</strong>
          <div class="widget-icon">
            <img src="/public/assets/images/icon-menunggu.svg" alt="" class="h-100  w-100 object-fit-cover">
          </div>
        </div>
        <div class="overflow-y-scroll h-100 mt-2 ">
          <table>
            <thead>
              <tr>
                <th>Kode</th>
                <th>Tanggal Peminjaman</th>
                <th>Waktu Pengembalian</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>123</td>
                <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
                </td>
                <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
                </td>
                <td>
                  <span class="rounded-2 " style="color: #A45B18; background-color: rgba(218, 114, 19, 0.30); padding: 0.6rem 1rem; user-select: none;">Menunggu</span>
                </td>
                <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
              </tr>
              <tr>
                <td>123</td>
                <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
                </td>
                <td>Sept 20, 2023<br><span class="rounded-2 mt-1 d-inline-block " style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;">11.00 AM</span>
                </td>
                <td>
                  <span class="rounded-2 " style="color: #A45B18; background-color: rgba(218, 114, 19, 0.30); padding: 0.6rem 1rem; user-select: none;">Menunggu</span>
                </td>
                <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="new-item-calendar-container rounded-3 row-gap-4 d-flex flex-column h-100">
        <div class="new-item-container bg-body-tertiary rounded-3 p-3 overflow-hidden h-100">
          <div class="d-flex justify-content-between">
            <strong style="color:#01305D">Barang Baru</strong>
            <div class="widget-icon">
              <img src="/public/assets/images/icon-barang-baru.svg" alt="" class="h-100  w-100 object-fit-cover">
            </div>
          </div>
          <div class="overflow-y-scroll d-flex flex-column gap-4 h-100 py-2 mt-2 ">
            <div class="d-flex gap-4">
              <div class="new-item-image-container">
                <img src="/public/assets/images/logo-tulisan.svg" alt="" class="w-100 h-100 object-fit-cover rounded-3" />
              </div>
              <div>
                <strong class="new-item-title">Missile</strong>
                <p class="new-item-stock text-body-tertiary">Stok: 10</p>
              </div>
            </div>
            <div class="d-flex gap-4">
              <div class="new-item-image-container">
                <img src="/public/assets/images/logo-tulisan.svg" alt="" class="w-100 h-100 object-fit-cover rounded-3" />
              </div>
              <div>
                <strong class="new-item-title">Missile</strong>
                <p class="new-item-stock text-body-tertiary">Stok: 10</p>
              </div>
            </div>
            <div class="d-flex gap-4">
              <div class="new-item-image-container">
                <img src="/public/assets/images/logo-tulisan.svg" alt="" class="w-100 h-100  object-fit-cover  rounded-3" />
              </div>
              <div>
                <strong class="new-item-title">Missile</strong>
                <p class="new-item-stock text-body-tertiary">Stok: 10</p>
              </div>
            </div>
          </div>
        </div>
        <div class="calendar-container calendar bg-body-tertiary rounded-3 h-100 p-2 ">
          <div class="text-center p-4  rounded-3 d-flex justify-content-center align-items-center position-relative">
            <strong class="calendar-month z-1">Desember 2023</strong>
            <div class="position-absolute w-100 h-100 d-flex justify-content-between align-items-center px-2 z-0 ">
              <button id="prevMonth" class="p-1 md- rounded-2" style="background-color: #01305D;">
                <i data-feather="chevron-left" class="text-white"></i>
              </button>
              <button id="nextMonth" class="p-1 rounded-2" style="background-color: #01305D;">
                <i data-feather="chevron-right" class="text-white"></i>
              </button>
            </div>
          </div>
          <div class="calendar-body row text-center">
            <table class="calendar-table">
              <thead>
                <th class="p-1 ">Sun</th>
                <th class="p-1 ">Mon</th>
                <th class="p-1 ">Tue</th>
                <th class="p-1 ">Wed</th>
                <th class="p-1 ">Thu</th>
                <th class="p-1 ">Fri</th>
                <th class="p-1 ">Sat</th>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="bg-warning rounded-3">1</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <td>7</td>
                  <td>8</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>10</td>
                  <td>11</td>
                  <td>12</td>
                  <td>13</td>
                  <td>14</td>
                  <td>15</td>
                </tr>
                <tr>
                  <td>16</td>
                  <td>17</td>
                  <td>18</td>
                  <td>19</td>
                  <td>20</td>
                  <td>21</td>
                  <td>22</td>
                </tr>
                <tr>
                  <td>23</td>
                  <td>24</td>
                  <td>25</td>
                  <td>26</td>
                  <td>27</td>
                  <td>28</td>
                  <td>29</td>
                </tr>
                <tr>
                  <td>30</td>
                  <td>31</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
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
              <td><strong>Tanggal Peminjaman</strong></td>
              <td><strong>:</strong></td>
              <td>
                15 Desember 2023 12:00
              </td>
            </tr>
            <tr>
              <td><strong>Waktu Pengembalian</strong></td>
              <td><strong>:</strong></td>
              <td>
                15 Desember 2023 12:00
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