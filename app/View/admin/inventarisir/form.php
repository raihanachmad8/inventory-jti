<div class="add-item-modal-container position-absolute top-0 start-0 h-100 d-flex flex-column row-gap-2
" style="background-color: #ececec; box-sizing: border-box;">
    <div>
        <h4><strong>Inventarisir/Penambahan Barang</strong></h4>
        <?php View::getFlashData()?>
        <?php var_dump($model)?>
    </div>
    <div class="w-100 h-100 bg-white add-item-modal p-4 rounded-3 " style="box-sizing: border-box;">
        <form action="/admin/inventarisir/formPost" method="post" id="add-item-form" class="d-flex w-100 h-100 gap-3" style="box-sizing: border-box;" enctype="multipart/form-data">
            <div class="flex-grow-1 w-100 h-100  d-flex flex-column row-gap-2">
                <div class="d-flex flex-column  input-container ">
                    <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Kode Barang</strong></label>
                    <input type="text" class="border rounded bg-body" name="kode">
                </div>
                <div class="d-flex flex-column  input-container ">
                    <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Nama Barang</strong></label>
                    <input type="text" class="border rounded bg-body" name="namaBarang">
                </div>
                <div class="d-flex flex-wrap w-100 gap-2  ">
                    <div class="d-flex flex-column   input-container flex-grow-1" style="width:45%">
                        <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Jumlah Barang</strong></label>
                        <input type="number" min="0" class="border rounded bg-body" name="jmlBarang">
                    </div>
                    <div class="d-flex flex-column   input-container flex-grow-1" style="width:45%">
                        <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Asal Barang</strong></label>
                        <select class="form-select" aria-label="Default select example" name="asal">
                            <<?php foreach ($model['asalList'] as $asal) : ?>
                                <option value="<?= $asal ?>"
                                    ><?= $asal ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column   input-container flex-grow-1" style="width:45%">
                        <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Maintainer</strong></label>
                        <select class="form-select" aria-label="Default select example" name="maintainer">
                        <?php foreach ($model['maintainerList'] as $maintainer) : ?>
                            <option value="<?= $maintainer ?>"
                                ><?= $maintainer ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column   input-container flex-grow-1" style="width:45%">
                        <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Kategori</strong></label>
                        <select class="form-select" aria-label="Default select example" name="kategori">
                            <?php foreach ($model['kategoriList'] as $kategori) : ?>
                                <option value="<?= $kategori ?>"
                                    ><?= $kategori ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-column input-container">
                    <label for=""><strong class="text-black-50 " style="font-size: 1.2rem;">Deskripsi</strong></label>
                    <textarea name="deskripsi" id="" cols="30" rows="10" style="resize: none;" class="border rounded bg-body p-2"></textarea>
                </div>
            </div>

            <div class="flex-grow-1 w-50 h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="flex-grow-1 w-100 h-100 position-relative">
                    <strong class="text-black-50" style="font-size: 1.2rem;">Gambar</strong>
                    <input type="file" class="d-none " accept=".jpg, .png, .jpeg" draggable="true" value="" id="add-item-image-input">
                    <label for="add-item-image-input" class="position-relative w-100 h-100 d-flex justify-content-center align-items-center rounded-2" style="cursor: pointer; border:4px dotted rgba(0, 0, 0, 0.25);">
                        <div class="position-relative w-100 h-100"><img class="insert-preview-image" style="background-repeat: no-repeat; object-fit: cover; width: 100%; height:100%; background-size:cover; background-position: center;"></div>
                        <div class="position-absolute d-flex justify-content-center align-items-center flex-column row-gap-3 ">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="80" height="80">
                                <path fill="#dee2e6" d="M9,5.5c0-.83,.67-1.5,1.5-1.5s1.5,.67,1.5,1.5-.67,1.5-1.5,1.5-1.5-.67-1.5-1.5Zm15-.5v6c0,2.76-2.24,5-5,5H10c-2.76,0-5-2.24-5-5V5C5,2.24,7.24,0,10,0h9c2.76,0,5,2.24,5,5ZM7,11c0,.77,.29,1.47,.77,2.01l5.24-5.24c.98-.98,2.69-.98,3.67,0l1.04,1.04c.23,.23,.62,.23,.85,0l3.43-3.43v-.38c0-1.65-1.35-3-3-3H10c-1.65,0-3,1.35-3,3v6Zm15,0v-2.79l-2.02,2.02c-.98,.98-2.69,.98-3.67,0l-1.04-1.04c-.23-.23-.61-.23-.85,0l-4.79,4.79c.12,.02,.24,.02,.37,.02h9c1.65,0,3-1.35,3-3Zm-3.91,7.04c-.53-.15-1.08,.17-1.23,.7l-.29,1.06c-.21,.77-.71,1.42-1.41,1.81-.7,.4-1.51,.5-2.28,.29l-8.68-2.38c-1.6-.44-2.54-2.09-2.1-3.69l.96-3.56c.14-.53-.17-1.08-.7-1.23-.53-.14-1.08,.17-1.23,.7L.18,15.29c-.73,2.66,.84,5.42,3.5,6.15l8.68,2.38c.44,.12,.89,.18,1.33,.18,.86,0,1.7-.22,2.47-.66,1.16-.66,1.99-1.73,2.35-3.02l.29-1.06c.15-.53-.17-1.08-.7-1.23Z" />
                            </svg><strong class="text-black-50 ">Upload</strong>
                        </div>
                    </label>
                </div>
                <div class="flex-grow-1 w-100 h-100 d-flex align-items-end ">
                    <div class="d-flex gap-3 w-100 ">
                        <!-- Harusnya ini button -->
                        <div class="btn cancel-button-add-item w-100 " style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</div>
                        <!-- Harusnya ini button -->
                        <div type="menu" class="btn text-white w-100 confirm-button-add-item " style="height:fit-content; background-color: #01305D;">Konfirmasi</div>
                    </div>
                </div>
            </div>

            <div style="z-index: 9999; background-color: rgba(0, 0, 0, 0.5);" class="confirmation-add-item-modal-container vw-100 vh-100 position-fixed top-0 start-0 d-flex justify-content-center align-items-center d-none">
                <div class="confirmation-add-item-modal d-flex align-items-center justify-content-center bg-light rounded-4 overflow-hidden " style="width: 50rem; height: 40rem;">
                    <div class="flex-grow-1 d-flex flex-column w-100 h-100 p-4 row-gap-3 ">
                        <h5><strong style="color: #01305D;">Konfirmasi Penambahan Barang</strong></h5>
                        <div class="flex-grow-1 w-100 h-100 column-gap-4 d-flex flex-wrap ">
                            <div class="flex-grow-1 w-100 column-gap-4 d-flex flex-wrap " style="height: 20rem;">
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Kode Barang</strong>
                                    <strong id="konfirmasi-kode" style="color: #01305D;">102938</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Kategori</strong>
                                    <strong id="konfirmasi-kategori" style="color: #01305D;">Elektronik</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Nama Barang</strong>
                                    <strong id="konfirmasi-namaBarang" style="color: #01305D;">Keyboard</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Jumlah Barang</strong>
                                    <strong id="konfirmasi-jmlBarang" style="color: #01305D;">100</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Maintainer</strong>
                                    <strong id="konfirmasi-maintainer" style="color: #01305D;">Mas Woon</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 input-container">
                                    <strong class="text-black-50">Asal Barang</strong>
                                    <strong id="konfirmasi-asal" style="color: #01305D;">Beli</strong>
                                </div>
                                <div class="d-flex flex-column gap-2 w-100">
                                    <strong class="text-black-50">Deskripsi</strong>
                                    <strong id="konfirmasi-deskripsi" style="color: #01305D;">Keyboard buat ketik ketik</strong>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between w-100 flex-grow-1 ">
                            <div class="flex-grow-1">
                                <button class="btn cancel-button-confirm-add-item" style="background-color: #fff; color:#01305D; border :2px solid #01305D">Batalkan</button>
                            </div>
                            <div class="flex-grow-1 d-flex justify-content-end column-gap-3 ">
                                <button type="submit" class="btn text-white save-button-confirm-add-item" style="height:fit-content; background-color: #01305D;">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1 w-100 h-100 position-relative ">
                        <img src="" alt="" id="konfirmasi-gambar" class="w-100 h-100 object-fit-cover background-size:contain; background-position:center">
                        <div class="w-100 h-100 position-absolute top-0 start-0 d-flex justify-content-center align-items-center bg-black opacity-25"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

