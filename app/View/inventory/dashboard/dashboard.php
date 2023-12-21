<div class="gap-4 p-4 pt-5 pt-lg-4  d-flex flex-column flex-md-row w-100" style=" color:#01305D">
    <div class="dashboard-widget-item flex-grow-1 bg-body-tertiary rounded-4 p-3 d-flex flex-column justify-content-between ">
        <div class="d-flex justify-content-between">
            <strong>Menunggu</strong>
            <div class="widget-icon">
                <img src="/public/assets/images/icon-menunggu.svg" alt="" class="h-100  w-100 object-fit-cover">
            </div>
        </div>
        <div class="text-center">
            <h1><?= $model['status']['Menunggu'] ?></h1>
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
            <h1><?= $model['status']['Diterima'] ?></h1>
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
            <h1><?= ((int)$model['status']['Selesai'] + (int) $model['status']['Dibatalkan'] + (int) $model['status']['Ditolak']) ?></h1>
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
            <h1><?= ((int)$model['status']['Proses'] + (int) $model['status']['Menunggu Ganti']) ?></h1>
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
                    <?php if (count($model['peminjaman']) > 0) : ?>
                        <?php foreach ($model['peminjaman'] as $peminjaman) : ?>
                            <tr>
                                <td><?= $peminjaman->ID_Transaksi ?></td>
                                <td><?= (new DateTime($peminjaman->StartDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($peminjaman->StartDate))->format('h:i A') ?></span></td>
                                <td><?= (new DateTime($peminjaman->EndDate))->format('M, d Y ') ?><br><span class="rounded-2 mt-1 d-inline-block" style="color: #19663D;background-color: rgba(40, 164, 97, 0.15); padding: 0.3rem 1rem; user-select: none;"><?= (new DateTime($peminjaman->EndDate))->format('h:i A') ?></span></td>
                                <td><span class="rounded-2 mt-1 d-inline-block" style="color: <?php
                                                                                                if ($peminjaman->Status->Nama_Status == 'Selesai') {
                                                                                                    echo '#28A461';
                                                                                                } elseif ($peminjaman->Status->Nama_Status == 'Menunggu') {
                                                                                                    echo '#A45B18';
                                                                                                } elseif ($peminjaman->Status->Nama_Status == "Proses") {
                                                                                                    echo '#C58208';
                                                                                                } elseif ($peminjaman->Status->Nama_Status == 'Diterima') {
                                                                                                    echo '#074B81';
                                                                                                } else {
                                                                                                    echo '#960000';
                                                                                                } ?>;background-color: <?php
                                                                                                                        if ($peminjaman->Status->Nama_Status == 'Selesai') {
                                                                                                                            echo 'rgba(40, 164, 97, 0.15)';
                                                                                                                        } elseif ($peminjaman->Status->Nama_Status == 'Menunggu') {
                                                                                                                            echo 'rgba(218, 114, 19, 0.15)';
                                                                                                                        } elseif ($peminjaman->Status->Nama_Status == "Proses") {
                                                                                                                            echo '#FFF9E1';
                                                                                                                        } elseif ($peminjaman->Status->Nama_Status == 'Diterima') {
                                                                                                                            echo 'rgba(158, 214, 251, 0.65)';
                                                                                                                        } else {
                                                                                                                            echo 'rgba(252, 64, 86, 0.30)';
                                                                                                                        } ?>; padding: 0.3rem 1rem; user-select: none;"><?= $peminjaman->Status->Nama_Status ?></span></td>
                                <td><button class="button-detail-history-loan btn" style="background-color: #CEE7FF; color:#01305D;" data-kode="<?= $peminjaman->ID_Transaksi ?>">Detail</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="new-item-calendar-container rounded-3 row-gap-4 d-flex flex-column h-100">
        <div class="new-item-container bg-body-tertiary rounded-3 p-3 overflow-hidden h-100">
            <div class="d-flex justify-content-between">
                <strong style="color:#01305D">Barang Tersedia</strong>
                <div class="widget-icon">
                    <img src="/public/assets/images/icon-barang-baru.svg" alt="" class="h-100  w-100 object-fit-cover">
                </div>
            </div>
            <div class="overflow-y-scroll d-flex flex-column gap-4 h-100 py-4 mt-2 ">
                <?php if (count($model['stok']) > 0) : ?>
                    <?php foreach ($model['stok'] as $stok) : ?>
                        <?php if ($stok['AvailableStock'] > 0) : ?>
                            <div class="d-flex gap-4 my-4">
                                <div class="new-item-image-container">
                                    <img src="/public/assets/images/inventarisir/<?= $stok['Gambar'] ?>" alt="" class="w-100 h-100 object-fit-cover rounded-3" />
                                </div>
                                <div>
                                    <strong class="new-item-title"><?= $stok['Nama_Inventaris'] ?></strong>
                                    <p class="new-item-stock text-body-tertiary">Stok: <?= $stok['AvailableStock'] ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <p class="text-center">Tidak ada barang tersedia</p>
                    </div>
                <?php endif; ?>


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
                    <td id="nama"></td>
                </tr>
                <tr>
                    <td><strong>Nomor ID</strong></td>
                    <td><strong>:</strong></td>
                    <td id="nomor-identitas"></td>
                </tr>
                <tr>
                    <td><strong>Status Peminjam</strong></td>
                    <td><strong>:</strong></td>
                    <td id="status-peminjam"></td>
                </tr>
                <tr>
                    <td><strong>Status Peminjaman</strong></td>
                    <td><strong>:</strong></td>
                    <td id="status"></td>
                </tr>
                <tr>
                    <td><strong>Keterangan</strong></td>
                    <td><strong>:</strong></td>
                    <td id="keterangan"></td>
                </tr>
                <tr>
                    <td><strong>Alasan Peminjaman</strong></td>
                    <td><strong>:</strong></td>
                    <td id="deskripsi-keperluan">

                    </td>
                </tr>
                <tr>
                    <td><strong>Tanggal Peminjaman</strong></td>
                    <td><strong>:</strong></td>
                    <td id="start-date">

                    </td>
                </tr>
                <tr>
                    <td><strong>Waktu Pengembalian</strong></td>
                    <td><strong>:</strong></td>
                    <td id="end-date">
                    </td>
                </tr>
                <tr id="tanda-pengenal">

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
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>1001</td>
                        <td>Kursi</td>
                        <td>5</td>
                        <td>Barang</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="py-4 d-flex detail-loan-button justify-content-end column-gap-3 ">
        <button class="button-back-loan btn text-white" style="background-color: #01305D;">Kembali</button>

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
<script>
    $('.button-detail-history-loan').each(function() {
        $(this).click(async function() {
            const kode = $(this).data('kode');
            await $.ajax({
                url: '/inventory/historyPeminjaman',
                method: 'GET',
                data: {
                    kode: kode
                },
                dataType: 'json',
                success: function(data) {
                    $(document).ready(() => {
                        const options = {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                            hour: "numeric",
                            minute: "numeric",
                            hour12: false, // Use 24-hour format
                        };
                        $('#nama').html(data.data.Pengguna.Nama_Pengguna);
                        $('#nomor-identitas').html(data.data.Pengguna.Nomor_Identitas);
                        $('#status-peminjam').html(data.data.Pengguna.Level.Nama_Level);
                        $('#status').html(data.data.Status.Nama_Status);
                        if (data.data.Status.Nama_Status == "Menunggu") {
                            $('.detail-loan-button').append(`<button class="button-cancel-loan btn btn-danger text-white">Batalkan</button>`);
                        }
                        $('#keterangan').html(data.data.Pesan);
                        $('#deskripsi-keperluan').html(data.data.Deskripsi_Keperluan === "undefined" ? "-" : data.data.Deskripsi_Keperluan);
                        $('#start-date').html(new Date(data.data.StartDate).toLocaleDateString("id-ID", options));
                        $('#end-date').html(new Date(data.data.EndDate).toLocaleDateString("id-ID", options));
                        if (data.data.Pengguna.Level.Nama_Level == 'Mahasiswa') {
                            $('#tanda-pengenal').html(`
                                <td><strong>Kartu Tanda Pengenal</strong></td>
                                <td><strong>:</strong></td>
                                <td>
                                    <div style="width: 250px; height: 150px;"><img src="" alt="" class="w-100 h-100 object-fit-cover ratio-16x9 rounded-3 "></div>
                                </td>
                                    `);
                            $('#tanda-pengenal img').attr('src', `/public/assets/images/jaminan/${data.data.Jaminan}`);
                        } else {
                            $('#tanda-pengenal').html('');
                        }
                        const table = function() {
                            let html = '';
                            data.data.DetailTransaksi.forEach((detail) => {
                                html += `
                                    <tr>
                                        <td>${detail.Inventaris.ID_Inventaris}</td>
                                        <td>${detail.Inventaris.Nama_Inventaris}</td>
                                        <td>${detail.Jumlah}</td>
                                        <td>${detail.Inventaris.Kategori.Nama_Kategori}</td>
                                        <td>${detail.Kondisi}</td>
                                    </tr>
                                    `;
                            })
                            return html;
                        }
                        $('.loan-detail-table tbody').html(table)
                        $('.cancel-loan-button').attr('data-kode', data.data.ID_Transaksi);
                        $('.content').addClass('d-none')
                        $('.modal-detail-container').removeClass('d-none');
                    })

                },
                error: (error) => {
                    $(document).ready(function() {
                        $('.modal-container-failed').removeClass('d-none');
                        $('#modal-container-failed-title').html('Gagal');
                        $('#modal-container-failed-message').html(error.responseJSON.error);

                    })
                }
            });
        })
    })

    $('.cancel-loan-button').click(function(e) {
        e.preventDefault();
        const kode = $(this).data('kode');
        $.ajax({
            url: `/inventory/history/delete?kode=${kode}`,
            method: 'DELETE',
            success: (data) => {
                $(document).ready(function() {
                    $('.delete-item-modal-container').addClass('d-none');
                    $('.modal-container').removeClass('d-none');
                    $('#modal-container-title').html('Berhasil');
                    $('#modal-container-message').html(data.message);

                })
            },
            error: (error) => {
                $(document).ready(function() {
                    $('.modal-container-failed').removeClass('d-none');
                    $('#modal-container-failed-title').html('Gagal');
                    $('#modal-container-failed-message').html(error.responseJSON.error);

                })
            }
        })
    })

    $(document).on('click', '.button-back-loan ', () => {
        $('.content').removeClass('d-none')
        $('.modal-detail-container').addClass('d-none');
    })
    $(document).on('click', '.delete-item-button-back ', () => {
        $('.cancel-loan-modal-container').addClass('d-none');
    })
    $(document).on('click', '.button-cancel-loan ', () => {
        $('.cancel-loan-modal-container').removeClass('d-none');
    })
</script>