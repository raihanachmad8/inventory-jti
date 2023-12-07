<div class="container-fluid pt-5 pb-4 px-4 w-100 d-flex flex-column row-gap-3">
  <div class="w-100 d-flex flex-column flex-lg-row row-gap-3 justify-content-between ">
    <h1 class="loans-heading">Maintainer</h1>
    <div class="h-100 d-flex justify-content-between column-gap-4 flex-column flex-lg-row row-gap-4">
      <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3 h-100">
        <input type="text" placeholder="Cari" class="w-100 px-3 rounded-3" style="border: none; outline: none; height: 3.5rem;">
        <div class="position-absolute bg-white" style=" width: 1.7rem; height: 1.7rem; right: 0.7rem;">
          <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
        </div>
      </div>
      <button class="h-100  btn btn-success add-new-maintainer-button"><i data-feather="plus"></i>Tambah Maintainer</button>
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
            <th>Nama Maintainer</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>0001</td>
            <td>Maintainer 1</td>
            <td>
              <button class="btn edit-maintainer-button text-white" style="background-color: #01305D;">Edit</button>
              <button class="btn btn-danger delete-maintainer-button">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="edit-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="detail-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
    <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
      <form id="detail-item-form" action="" class="flex-grow-1 w-100 h-100  column-gap-4 d-flex flex-wrap ">
        <div class="d-flex flex-column gap-3 input-container">
          <strong><label for="">Kode Maintainer</label></strong>
          <input type="text" class="border rounded bg-body p-2 " value="0001">
        </div>
        <div class="d-flex flex-column gap-3 input-container">
          <strong><label for="">Nama Maintainer</label></strong>
          <input type="text" class="border rounded bg-body p-2 " value="Pak Putra">
        </div>
      </form>
      <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
        <div class="flex-grow-1">
          <button class="btn cancel-button-edit-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
        </div>
        <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
          <button class="btn text-white confirm-button-edit-maintainer" style="height:fit-content; background-color: #01305D;">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="add-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="detail-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
    <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
      <form id="detail-item-form" action="" class="flex-grow-1 w-100 h-100  column-gap-4 d-flex flex-wrap ">
        <div class="d-flex flex-column gap-3 input-container">
          <strong><label for="">Kode Maintainer</label></strong>
          <input type="text" class="border rounded bg-body p-2 " placeholder="Masukkan Kode Maintainer">
        </div>
        <div class="d-flex flex-column gap-3 input-container">
          <strong><label for="">Nama Maintainer</label></strong>
          <input type="text" class="border rounded bg-body p-2 " placeholder="Masukkan Nama Maintainer">
        </div>
      </form>
      <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
        <div class="flex-grow-1">
          <button class="btn cancel-button-add-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
        </div>
        <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
          <button class="btn text-white confirm-button-add-maintainer" style="height:fit-content; background-color: #01305D;">Konfirmasi</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="confirmation-add-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="confirmation-add-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: fit-content; height: fit-content;">
    <div class="flex-grow-1 d-flex flex-column w-100 p-4 row-gap-3 ">
      <h5><strong style="color: #01305D;">Konfirmasi Penambahan Maintainer</strong></h5>
      <div class="w-100 column-gap-4 d-flex flex-wrap ">
        <div class="d-flex flex-column gap-2" style="height: fit-content;">
          <strong class="text-black-50">Kode Maintainer</strong>
          <strong style="color: #01305D;">102938</strong>
        </div>
        <div class="d-flex flex-column gap-2" style="height: fit-content;">
          <strong class="text-black-50">Nama Maintainer</strong>
          <strong style="color: #01305D;">Keyboard</strong>
        </div>
      </div>
      <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
        <div class="flex-grow-1">
          <button class="btn cancel-button-confirm-add-maintainer" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
        </div>
        <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
          <button class="btn text-white save-button-confirm-add-maintainer" style="height:fit-content; background-color: #01305D;">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-add-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p>Penambahan Maintainer Berhasil Dilakukan</p>
    </div>
    <div>
      <button class="btn text-white add-maintainer-success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-edit-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <p>Perubahan Maintainer Berhasil Disimpan</p>
    </div>
    <div>
      <button class="btn text-white edit-maintainer-success-button-back" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="delete-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
  <div class="delete-item-modal d-flex flex-column align-items-center justify-content-evenly rounded-4 overflow-hidden" style="width: 25rem; height: 25rem; background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,1) 65%, rgba(255,219,222,1) 65%);">
    <div class="d-flex flex-column align-items-center ">
      <img src="/public/assets/images/batalkan.svg" alt="">
      <h3 style="color: #CC3333;">
        <strong>
          Hapus Maintainer
        </strong>
      </h3>
    </div>
    <div>
      <p class="text-center">Apakah Anda yakin ingin menghapus maintainer ini?</p>
    </div>
    <div class="d-flex gap-3 w-100 justify-content-evenly ">
      <button class="btn text-white delete-maintainer-button-back" style="background-color: #01305D; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
      <button class="btn btn-danger delete-maintainer-button-delete"><strong>Hapus</strong></button>
    </div>
  </div>
</div>

<!-- <div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-edit-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
</div> -->

<div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="success-delete-maintainer-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none ">
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
      <button class="btn text-white delete-maintainer-success-button" style="background-color: #5BD794; padding: 0.5rem 1rem;"><strong>Kembali</strong></button>
    </div>
  </div>
</div>