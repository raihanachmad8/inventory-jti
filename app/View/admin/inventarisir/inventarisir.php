<div class="container-fluid pt-lg-3 pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
  <div class="w-100 d-flex flex-column flex-lg-row row-gap-3 justify-content-between align-items-lg-center ">
    <h3 class="loans-heading">Inventarisir</h3>
    <div class="h-100 d-flex justify-content-between column-gap-4 flex-column flex-lg-row row-gap-4">
      <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3 h-100">
        <input type="text" placeholder="Cari" class="w-100 px-3 rounded-3" style="border: none; outline: none; height: 2.5rem;">
        <div class="position-absolute bg-white" style=" width: 1.5rem; height: 1.5rem; right: 0.7rem;">
          <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
        </div>
      </div>
      <button class="h-100 btn btn-success add-new-item-button"><i data-feather="plus"></i>Tambah Barang</button>
    </div>
  </div>
</div>

<div class="m-auto gap-4 d-flex overflow-hidden pb-4 px-4 rounded-4 w-100 h-100">
  <div class="bg-body-tertiary rounded-3 h-100 w-100 p-3 overflow-hidden">
    <div class="overflow-y-scroll h-100">
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Asal</th>
            <th>Maintainer</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>00001</td>
            <td>Kulkas</td>
            <td>2</td>
            <td>Hibah</td>
            <td>Putra</td>
            <td>Elektronik</td>
            <td><button class="button-detail-item btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
          <tr>
            <td>00001</td>
            <td>Kulkas</td>
            <td>2</td>
            <td>Hibah</td>
            <td>Putra</td>
            <td>Elektronik</td>
            <td><button class="button-detail-item btn" style="background-color: #CEE7FF; color:#01305D;">Detail</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div style="background-color: rgba(0, 0, 0, 0.5);" class="detail-item-modal-container vw-100 overflow-y-scroll position-absolute top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="detail-item-modal d-flex flex-column flex-lg-row align-items-center justify-content-center bg-light overflow-hidden ">
    <div class="order-last order-lg-first flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
      <form id="detail-item-form" action="" class="flex-grow-1 w-100 h-100">
        <div class="d-flex flex-column gap-3 input-container">
          <label class="fw-semibold ">Kode Barang</label>
          <p>0001</p>
        </div>
        <div class="d-none">
          <input type="file" id="image-input">
        </div>
        <div class="d-flex flex-column gap-3 input-container">
          <label class="fw-semibold " for="kategori">Kategori</label>
          <select class="form-select" id="kategori" aria-label="Default select example">
            <option value="atk">ATK</option>
            <option value="elektronik">Elektronik</option>
            <option value="peralatan">Peralatan</option>
          </select>
        </div>
        <div class="d-flex flex-column gap-3 input-container">
          <label class="fw-semibold " for="namaBarang">Nama Barang</label>
          <input type="text" id="namaBarang" class="border rounded bg-body" value="Keyboard">
        </div>
        <div class="d-flex flex-column gap-3 input-container">
          <label class="fw-semibold " for="jumlahBarang">Jumlah Barang</label>
          <input type="text" id="jumlahBarang" class="border rounded bg-body input" value="100">
        </div>
        <div class="d-flex flex-column input-container flex-grow-1 w-100 ">
          <p class="fw-semibold ">Maintainer</p>
          <div style="display:grid; grid-template-columns: 1fr 1fr">
            <div class="form-check d-flex align-items-center gap-3 gap-lg-2  ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer">
              <label class="form-check-label" for="maintainer">
                Pak Woon
              </label>
            </div>
            <div class="form-check d-flex align-items-center gap-3 gap-lg-2 ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer1">
              <label class="form-check-label" for="maintainer1">
                Pak Woon
              </label>
            </div>
            <div class="form-check d-flex align-items-center gap-3  gap-lg-2 ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer2">
              <label class="form-check-label" for="maintainer2">
                Pak Woon
              </label>
            </div>
            <div class="form-check d-flex align-items-center gap-3 gap-lg-2 ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer3">
              <label class="form-check-label" for="maintainer3">
                Pak Woon
              </label>
            </div>
            <div class="form-check d-flex align-items-center gap-3 gap-lg-2 ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer4">
              <label class="form-check-label" for="maintainer4">
                Pak Woon
              </label>
            </div>
            <div class="form-check d-flex align-items-center gap-3 gap-lg-2 ps-0 ">
              <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer5">
              <label class="form-check-label" for="maintainer5">
                Pak Woon
              </label>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column gap-3 input-container w-100">
          <label class="fw-semibold " for="asalBarang">Asal Barang</label>
          <select id="asalBarang" class="form-select" aria-label="Default select example"">
            <option value=" hibah">Hibah</option>
            <option value="beli">Beli</option>
          </select>
        </div>
        <div class="d-flex flex-column input-container gap-3 w-100">
          <label class="fw-semibold " for="keterangan">Keterangan</label>
          <textarea name="" id="keterangan" class="w-100 h-100 border bg-body rounded p-2 " style="resize: none;" value="Keyboard cetik cetik lurrr">Keyboard cetik cetik lurrr</textarea>
        </div>
      </form>
      <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
        <div class="flex-grow-1">
          <button class="btn cancel-button-detail-item" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
        </div>
        <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
          <button class="delete-button-detail-item btn text-white" style="height:fit-content; background-color: #CC3333;">Hapus</button>
          <button class="btn text-white save-button-detail-item" style="height:fit-content; background-color: #01305D;">Simpan</button>
        </div>
      </div>
    </div>
    <div class="flex-grow-1 w-100 h-100 position-relative ">
      <img src="/public/assets/images/jay-zhang-ZByWaPXD2fU-unsplash.jpg" alt="" class="w-100 h-100 object-fit-cover ">
      <label for="image-input" class="w-100 h-100 position-absolute top-0 start-0 d-flex flex-column  justify-content-center align-items-center z-2 " style=" cursor: pointer;">
        <img src="/public/assets/images/images.svg" alt="" style="width: 5rem; height: 5rem;">
        <strong style="font-size: 1.5rem;" class="text-white">Edit</strong>
      </label>
      <div class="w-100 h-100 position-absolute top-0 start-0 d-flex justify-content-center align-items-center bg-black opacity-25"></div>
    </div>
  </div>
</div>

<div class="add-item-modal-container position-absolute top-0 start-0 d-flex flex-column row-gap-2 d-none " style="background-color: #ececec; box-sizing: border-box;">
  <div class="w-100 bg-white add-item-modal p-4 rounded-3 " style="box-sizing: border-box;">
    <form id="add-item-form" class="d-flex flex-column flex-lg-row w-100 h-100 gap-3" style="box-sizing: border-box;">
      <div class="flex-grow-1 w-100 h-100 d-flex flex-column row-gap-2">
        <div class="d-flex flex-column  input-container ">
          <label class="fw-semibold" for="namaBarang">Nama Barang</label>
          <input id="namaBarang" type="text" class="border rounded bg-body p-2 " placeholder="Masukkan Nama Barang" required>
        </div>
        <div class="d-flex flex-wrap w-100 gap-2 flex-column flex-lg-row">
          <div class="d-flex flex-column input-container flex-grow-1">
            <label class="fw-semibold" for="jumlahBarang">Jumlah Barang</label>
            <input id="jumlahBarang" type="text" class="border rounded bg-body p-2 " placeholder="Masukkan Jumlah Barang" required>
          </div>
          <div class="d-flex flex-column input-container flex-grow-1">
            <label class="fw-semibold" for="asalBarang">Asal Barang</label>
            <select id="asalBarang" class="form-select p-2" aria-label="Default select example" required>
              <option value="Beli">Beli</option>
              <option value="Hibah">Hibah</option>
            </select>
          </div>
          <div class="d-flex flex-column input-container flex-grow-1 w-100 ">
            <label class="fw-semibold" for="kategori">Kategori</label>
            <select id="kategori" class="form-select" aria-label="Default select example" required>
              <option value="ATK">ATK</option>
              <option value="Elektronik">Elektronik</option>
              <option value="Peralatan">Peralatan</option>
            </select>
          </div>
          <div class="d-flex flex-column input-container flex-grow-1 w-100 ">
            <p class="fw-semibold">Maintainer</p>
            <div class="maintainer-input-container">
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer">
                <label class="form-check-label" for="maintainer">
                  Pak Woon
                </label>
              </div>
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer1">
                <label class="form-check-label" for="maintainer1">
                  Pak Woon
                </label>
              </div>
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer2">
                <label class="form-check-label" for="maintainer2">
                  Pak Woon
                </label>
              </div>
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer3">
                <label class="form-check-label" for="maintainer3">
                  Pak Woon
                </label>
              </div>
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer4">
                <label class="form-check-label" for="maintainer4">
                  Pak Woon
                </label>
              </div>
              <div class="form-check d-flex align-items-center gap-3 ps-0 ">
                <input class="form-check-input" type="checkbox" value="Pak Woon" id="maintainer5">
                <label class="form-check-label" for="maintainer5">
                  Pak Woon
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column input-container h-100 ">
          <label class="fw-semibold" for="keterangan">Keterangan</label>
          <textarea name="" id="keterangan" cols="30" style="resize: none;" placeholder="Masukkan Keterangan" class="border rounded bg-body p-2 h-100"></textarea>
        </div>
      </div>
      <div class="image-upload-button-container flex-grow-1 d-flex flex-column justify-content-lg-center justify-content-start  align-items-center">
        <div class="flex-lg-grow-1 w-100 position-relative">
          <p class="fw-semibold">Gambar</p>
          <input type="file" class="d-none " id="add-item-image-input">
          <label for="add-item-image-input" class="position-relative d-flex justify-content-center align-items-center rounded-2" style="cursor: pointer; border:4px dotted rgba(0, 0, 0, 0.25);">
            <div class="d-flex justify-content-center align-items-center flex-column row-gap-3 p-4 p-md-0">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="80" height="80">
                <path fill="#dee2e6" d="M9,5.5c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Zm15-.5v6c0,2.76-2.24,5-5,5H10c-2.76,0-5-2.24-5-5V5C5,2.24,7.24,0,10,0h9c2.76,0,5,2.24,5,5ZM7,11c0,.77,.29,1.47,.77,2.01l5.24-5.24c.98-.98,2.69-.98,3.67,0l1.04,1.04c.23,.23,.62,.23,.85,0l3.43-3.43v-.38c0-1.65-1.35-3-3-3H10c-1.65,0-3,1.35-3,3v6Zm15,0v-2.79l-2.02,2.02c-.98,.98-2.69,.98-3.67,0l-1.04-1.04c-.23-.23-.61-.23-.85,0l-4.79,4.79c.12,.02,.24,.02,.37,.02h9c1.65,0,3-1.35,3-3Zm-3.91,7.04c-.53-.15-1.08,.17-1.23,.7l-.29,1.06c-.21,.77-.71,1.42-1.41,1.81-.7,.4-1.51,.5-2.28,.29l-8.68-2.38c-1.6-.44-2.54-2.09-2.1-3.69l.96-3.56c.14-.53-.17-1.08-.7-1.23-.53-.14-1.08,.17-1.23,.7L.18,15.29c-.73,2.66,.84,5.42,3.5,6.15l8.68,2.38c.44,.12,.89,.18,1.33,.18,.86,0,1.7-.22,2.47-.66,1.16-.66,1.99-1.73,2.35-3.02l.29-1.06c.15-.53-.17-1.08-.7-1.23Z" />
              </svg><p class="fw-semibold text-black-50 ">Upload</p>
            </div>
          </label>
        </div>
        <div class="w-100 d-flex align-items-end ">
          <div class="d-flex gap-3 w-100 ">
            <!-- Harusnya ini button -->
            <div class="btn cancel-button-add-item w-100 " style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</div>
            <!-- Harusnya ini button -->
            <div type="menu" class="btn text-white w-100 confirm-button-add-item " style="height:fit-content; background-color: #01305D;">Konfirmasi</div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="confirmation-add-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="confirmation-add-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: 50rem; height: 40rem;">
    <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
      <h5><strong style="color: #01305D;">Konfirmasi Penambahan Barang</strong></h5>
      <div class="flex-grow-1 w-100 h-100 column-gap-4 d-flex flex-wrap ">
        <div class="flex-grow-1 w-100 column-gap-4 d-flex flex-wrap " style="height: 20rem;">
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Kode Barang</strong>
            <strong style="color: #01305D;">102938</strong>
          </div>
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Kategori</strong>
            <strong style="color: #01305D;">Elektronik</strong>
          </div>
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Nama Barang</strong>
            <strong style="color: #01305D;">Keyboard</strong>
          </div>
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Jumlah Barang</strong>
            <strong style="color: #01305D;">100</strong>
          </div>
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Maintainer</strong>
            <strong style="color: #01305D;">Mas Woon</strong>
          </div>
          <div class="d-flex flex-column gap-2 input-container">
            <strong class="text-black-50">Asal Barang</strong>
            <strong style="color: #01305D;">Beli</strong>
          </div>
          <div class="d-flex flex-column gap-2 w-100">
            <strong class="text-black-50">Keterangan</strong>
            <strong style="color: #01305D;">Keyboard buat ketik ketik</strong>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
        <div class="flex-grow-1">
          <button class="btn cancel-button-confirm-add-item" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
        </div>
        <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
          <button class="btn text-white save-button-confirm-add-item" style="height:fit-content; background-color: #01305D;">Simpan</button>
        </div>
      </div>
    </div>
    <div class="flex-grow-1 w-100 h-100 position-relative ">
      <img src="/public/assets/images/jay-zhang-ZByWaPXD2fU-unsplash.jpg" alt="" class="w-100 h-100 object-fit-cover ">
      <div class="w-100 h-100 position-absolute top-0 start-0 d-flex justify-content-center align-items-center bg-black opacity-25"></div>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-add-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="success-add-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
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
      <p>Penambahan Barang Berhasil Dilakukan</p>
    </div>
    <div>
      <button class="btn text-white add-item-success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="delete-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="delete-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
    <div class="d-flex flex-column align-items-center ">
      <img src="/public/assets/images/batalkan.svg" alt="">
      <h3 style="color: #CC3333;">
        <strong>
          Hapus Barang
        </strong>
      </h3>
    </div>
    <div>
      <p>Apakah Anda yakin ingin menghapus barang ini?</p>
    </div>
    <div class="d-flex gap-3 w-100 justify-content-evenly ">
      <button class="btn text-white delete-item-button-back" style="background-color: #01305D; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
      <button class="btn btn-danger delete-item-button"><strong>Hapus</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-edit-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p>Perubahan data barang berhasil dilakukan</p>
    </div>
    <div>
      <button class="btn text-white edit-item-success-button" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-delete-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p>Data berhasil dihapus</p>
    </div>
    <div>
      <button class="btn text-white delete-item-success-button" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>