<div class="container-fluid p-4 w-100  d-flex flex-column row-gap-3">
    <div class="w-100 d-flex flex-column flex-md-row row-gap-3  justify-content-between ">
        <h1 class="loans-heading">Peminjaman</h1>
        <div class="h-100 d-flex justify-content-between column-gap-4 ">
            <div class="search-bar-container d-flex gap-2 position-relative overflow-hidden d-flex justify-content-center align-items-center rounded-3">
                <input type="text" placeholder="Cari" name="search-input" class="w-100 h-100 px-3 rounded-3" style="border: none; outline: none;">
                <div class="position-absolute bg-white" style="width: 1.7rem; height: 1.7rem; right: 0.7rem;">
                    <img src="/public/assets/images/search.svg" alt="" class="w-100 h-100">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="inventory-items-container w-100 pb-4 px-4 overflow-y-scroll ">
    <?php if (count($model['peminjaman']) > 0) : ?>

        <?php foreach ($model['peminjaman'] as $peminjaman) : ?>
            <div class="inventory-item w-100 h-100  d-flex flex-column bg-body-tertiary p-2 gap-2 p-xl-3">
                <div class="flex-grow-1">
                    <img src="/public/assets/images/inventarisir/<?= $peminjaman['Gambar'] ?>" alt="" class="w-100 object-fit-cover h-100 ratio-1x1 rounded-2" />
                </div>
                <div class="text-dark">
                    <div class="d-flex justify-content-between flex-column row-gap-4 ">
                        <div class="inventory-item-name-data flex-grow-1 d-flex justify-content-between">
                            <p style="font-size: 0.8rem;"><strong><?= $peminjaman['Nama_Inventaris'] ?></strong>/<?= $peminjaman['Kategori']->Nama_Kategori ?></p>
                            <strong><?= $peminjaman['AvailableStock'] ?>/<?= $peminjaman['Stok'] ?></strong>
                        </div>
                        <div class="inventory-item-qty-data flex-grow-1 d-flex justify-content-between align-items-center">
                            <p class="text-body-tertiary d-inline-block w-50" style="font-size: 0.8rem;"><?= $peminjaman['MaintainerNames'][0] ?></p>
                            <div class="inventory-item-button-container flex-grow-1 w-75 d-flex justify-content-between align-items-center">
                                <div class="counter-container w-100 d-flex justify-content-between d-none">
                                    <label for="pinjam" class="btn-counter btn-counter-minus btn btn-primary">-</label>
                                    <input id="count_<?= $peminjaman['ID_Inventaris'] ?>" type="number" value="0" class="counter-input w-50 rounded bg-dark-subtle" />
                                    <label for="pinjam" class="btn-counter btn-counter-plus btn btn-primary" data-max="<?= $peminjaman['AvailableStock'] ?>">+</label>
                                </div>
                                <button class="inventory-item-button w-100 h-100  btn text-white" style="background-color: #01305d; font-size: 0.8rem;" type="button" data-kode="<?= $peminjaman['ID_Inventaris'] ?>">Pinjam</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="w-100 position-absolute d-flex justify-content-center align-items-center">
            <h1 style="font-size: 1.5rem;" class="text-body-tertiary">Tidak ada data</h1>
        <?php endif; ?>
        </div>

        <div class="loan-button-container w-100 py-3 px-3 bg-body-tertiary position-fixed bottom-0 d-flex justify-content-between">
            <button class="loan-button btn w-100 text-white" style="background-color: #01305D;" type="button" disabled>Pinjam(0)</button>
        </div>

        <div class="confirmation-modal-container container-fluid position-absolute w-100 bg-white d-none" style="color: #01305D;">
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
                            <td><?= $model['pengguna']->Nama_Pengguna ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nomor ID</strong></td>
                            <td><strong>:</strong></td>
                            <td><?= $model['pengguna']->Nomor_Identitas ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Peminjaman</strong></td>
                            <td><strong>:</strong></td>
                            <td>
                                <div class="w-75 d-flex flex-column flex-lg-row row-gap-3 row-gap-lg-0 column-gap-3 ">
                                    <input id="borrowDate" type="date" class="form-control" />
                                    <input id="borrowTime" type="time" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Waktu Pengembalian</strong></td>
                            <td><strong>:</strong></td>
                            <td>
                                <div class="w-75 d-flex flex-column flex-lg-row row-gap-3 row-gap-lg-0 column-gap-3 ">
                                    <input id="returnDate" type="date" class="form-control" />
                                    <input id="returnTime" type="time" class="form-control">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="inventory-loans-table-container  text-center">
                <table class="inventory-loans-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Keyboard</td>
                            <td>1</td>
                            <td>Keyboard</td>
                            <td>
                                <form action="" class="form-choose">
                                    <input class="form-check-input border border-dark " type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px;">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="guarantee-reason-container" style="margin-top: 5rem;">
                <div class="d-flex row-gap-3 flex-column">
                <strong>
                    <h5>Upload KTP / KTM</h5>
                </strong>
                <label for="image" class="d-flex justify-content-center align-items-center border rounded-3 w-100 h-100 " style="cursor: pointer;">
                    <!-- <i data-feather="image" style="width: 3rem; height:3rem; " class="text-body-tertiary"></i>
                -->
                    <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 rounded-3 h-100 object-fit-contain  " style="max-height: 250px;">
                </label>
                <input id="image" type="file" class="d-none">
                </div>
                <div class="d-flex row-gap-3 flex-column">
                <strong>
                    <h5>Alasan Peminjaman</h5>
                </strong>
                <textarea name="deskripsi_keperluan" id="" cols="30" rows="10" placeholder="Masukkan Alasan Peminjaman" style="resize: none;" class="w-100 border rounded-3 p-2 "></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end pt-2">
                <button class="btn btn-success w-100 button-submit-loan-application" type="submit">Submit</button>
            </div>
        </div>

        <div class="calendar-modal-container position-fixed vw-100 top-0 start-0  vh-100 d-flex justify-content-center align-items-center d-none " style="background-color: rgba(0, 0, 0, 0.5); z-index: 9999;">
            <div class="calendar-container-inner rounded-5 bg-light-subtle d-flex flex-column p-4 row-gap-4">
                <div class="d-flex justify-content-between align-items-center  border-bottom border-black">
                    <strong>Pilih Waktu</strong>
                    <button class="date-modal-close btn"><i data-feather="x"></i></button>
                </div>
                <h5>28-November-2023 22:56</h5>
                <div class="calendar-body-container w-100 h-100 d-flex flex-column flex-lg-row z-3">
                    <div class="calendar bg-body-tertiary rounded-3 p-2  ">
                        <div class="text-center p-4 rounded-3 d-flex justify-content-center align-items-center position-relative" style="height: 4rem;">
                            <strong class="calendar-month z-1 " style="font-size: 1rem">Desember 2023</strong>
                            <div class="position-absolute w-100 h-100 d-flex justify-content-between align-items-center px-2 z-0 ">
                                <button class="p-1 rounded-2" style="background-color: #01305D;">
                                    <i data-feather="chevron-left" class="text-white"></i>
                                </button>
                                <button class="p-1 rounded-2 " style="background-color: #01305D;">
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
                    <div class="flex-grow-1 w-100 d-flex justify-content-lg-evenly  justify-content-center  align-items-center  ">
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
                <div class="w-100 d-flex justify-content-end ">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>


<script>
    $('input[name="search-input"]').keypress(function(e) {
        const keyword = e.target.value;
        if (e.key === 'Enter') {
            window.location.href = `/inventory/peminjaman?search=${keyword}`;
        }
    })


    let checkoutItems = [];

    // Function to add or remove an item from the checkout array
    function updateCheckout(itemId, count) {
        // Find the index of the item in the checkout array
        let itemIndex = checkoutItems.findIndex(item => item.ID === itemId);

        if (count > 0) {
            // Add or update the item in the checkout array
            if (itemIndex !== -1) {
                checkoutItems[itemIndex].count = count;
            } else {
                checkoutItems.push({
                    ID: itemId,
                    count: count
                });
            }
        } else {
            // Remove the item from the checkout array if count is 0
            if (itemIndex !== -1) {
                checkoutItems.splice(itemIndex, 1);
            }
        }
        updateLoanButtonState();

        // Optionally, you can display a message or update the UI
        console.log("Checkout Items:", checkoutItems);
    }

    // Function to handle button click
    function handleButtonClick(itemId, operation) {
        let countInput = $('#count_' + itemId);
        let count = parseInt(countInput.val());

        if (operation === 'plus') {
            count += 1;
        } else if (operation === 'minus') {
            count -= 1;
        }
        // Update the input field value
        countInput.val(count);
        // Update the checkout array
        updateCheckout(itemId, count);
    }

    $('.loan-button-container').click(function() {
        let result = '';
        checkoutItems.map((v, k) => {
            result += '<tr><td>' + v.ID + '</td><td>' + v.Nama + '</td><td>' + v.count + '</td><td>' + v.Kategori + '</td><td><input class="form-check-input border border-dark " type="checkbox" value="" id="flexCheckDefault" style="width: 20px; height: 20px;"></td></tr>';
        })
        $('.inventory-loans-table tbody').html(result);
        $('.confirmation-modal-container').removeClass('d-none');
    })

    $('.inventory-item-button').each(function() {
        $(this).click(function() {
            const kode = $(this).data('kode');
            const count = parseInt($(`#count_${kode}`).val()) + 1;
            $('#count_' + kode).val(count);
            updateCheckout(kode, count);
            if (count > 0) {
                console.log($(this).closest('.inventory-item').find('.inventory-item-name-data p').text());
                checkoutItems.find(item => item.ID === kode).Nama = $(this).closest('.inventory-item').find('.inventory-item-name-data p').text().split('/')[0];
                checkoutItems.find(item => item.ID === kode).Kategori = $(this).closest('.inventory-item').find('.inventory-item-name-data p').text().split('/')[1];
                $(this).addClass('d-none');
                $(this).siblings('.counter-container').removeClass('d-none');
                $(this).siblings('.counter-container').find('.btn-counter-plus').attr('data-kode', kode);
                $(this).siblings('.counter-container').find('.btn-counter-minus').attr('data-kode', kode);
            }
        })
    })

    $('.btn-counter-plus').each(function() {
        $(this).click(function() {
            const kode = $(this).data('kode');
            const max = $(this).data('max');
            if (parseInt($(`#count_${kode}`).val()) < max) {
                handleButtonClick(kode, 'plus');
            }
        })
    })

    $('.btn-counter-minus').each(function() {
        $(this).click(function() {
            const kode = $(this).data('kode');
            console.log($(`#count_${kode}`).val());
            if (parseInt($(`#count_${kode}`).val()) === 1) {
                $(this).parent().addClass('d-none');
                $(this).parent().siblings('.inventory-item-button').removeClass('d-none');
            }
            handleButtonClick(kode, 'minus');
        })
    })

    function updateLoanButtonState() {
        const total = checkoutItems.length;
        if (total > 0) {
            $('.loan-button').attr('disabled', false);
            $('.loan-button').text(`Pinjam (${total})`);
        } else {
            $('.loan-button').attr('disabled', true);
            $('.loan-button').text(`Pinjam (${total})`);
        }
    }

    $(document).ready(function() {
        $('#returnDate, #returnTime').change(function() {
            let borrowDateTime = new Date($('#borrowDate').val() + ' ' + $('#borrowTime').val());
            let returnDateTime = new Date($('#returnDate').val() + ' ' + $('#returnTime').val());


            // Calculate the minimum allowed borrow time (current time + 1 hour)
            let minBorrowTime = new Date(borrowDateTime.getTime() + (1 * 60 * 60 * 1000));

            // Check if the return date and time are not earlier than the borrowing date and time
            if (returnDateTime < borrowDateTime) {
                $('.modal-container-failed').removeClass('d-none');
                $('#modal-container-failed-title').html('Gagal');
                $('#modal-container-failed-message').html('Tanggal dan waktu pengembalian tidak boleh lebih awal dari tanggal dan waktu peminjaman')
                // Automatically set return date and time to be the same as borrowing date and time
                $('#returnDate').val($('#borrowDate').val());
                $('#returnTime').val($('#borrowTime').val());
            }

        });
    });

    $('#borrowDate, #borrowTime').change(function() {
        // Get the selected borrow date and time
        var borrowDateTime = new Date($('#borrowDate').val() + ' ' + $('#borrowTime').val());

        // Get the current time
        var currentTime = new Date();

        // Calculate the minimum allowed borrow time (current time + 1 hour)
        var minBorrowTime = new Date(currentTime.getTime() + (1 * 60 * 60 * 1000));

        // Check if the selected borrow time is at least 1 hour after the current time
        if (borrowDateTime < minBorrowTime) {
            // Display a validation message or take appropriate action
            $('.modal-container-failed').removeClass('d-none');
            $('#modal-container-failed-title').html('Gagal');
            $('#modal-container-failed-message').html('Tanggal dan waktu peminjaman harus minimal 1 jam sebelum waktu saat ini');
            // Automatically set borrow date and time to be 1 hour after the current time
            $('#borrowDate').val(formatDate(minBorrowTime));

            $('#borrowTime').val(formatTime(minBorrowTime));
        }
    });


    // Function to format date
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    // Function to format time
    function formatTime(date) {
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return hours + ':' + minutes;
    }


    $('.button-submit-loan-application').click(function(e) {
        e.preventDefault();
        const check = $('.form-check-input:checked');
        const checkoutItems = [];
        check.each(function() {
            const kode = $(this).closest('tr').find('td').eq(0).text();
            const nama = $(this).closest('tr').find('td').eq(1).text();
            const kategori = $(this).closest('tr').find('td').eq(3).text();
            const count = $(this).closest('tr').find('td').eq(2).text();
            checkoutItems.push({
                ID_Inventaris: kode,
                Nama_Inventaris: nama,
                Nama_Kategori: kategori,
                Jumlah: count
            })
        })
        const borrowDateTime = $('#borrowDate').val() + ' ' + $('#borrowTime').val();
        const returnDateTime = $('#returnDate').val() + ' ' + $('#returnTime').val();
        const reason = $('textarea[name="deskripsi_keperluan"]').val();
        const image = $('#image').val();


        // Validate if items are selected
        if (checkoutItems.length === 0) {
            showValidationError('No items selected for checkout');
            return;
        }

        // Validate if borrow date and time are filled
        if ($('#borrowDate').val().trim() === '' || $('#borrowTime').val().trim() === '') {
            showValidationError('Borrow date and time are required');
            return;
        }

        // Validate if return date and time are filled
        if ($('#returnDate').val().trim() === '' || $('#returnTime').val().trim() === '') {
            showValidationError('Return date and time are required');
            return;
        }

        // Validate if reason is filled
        if ($('textarea').val().trim() === '') {
            showValidationError('Reason is required');
            return;
        }

        // Validate if image is selected (assuming you are using an input type="file" for image)
        if ($('#image').val().trim() === '') {
            showValidationError('Image is required');
            return;
        }


        const formData = new FormData();
        formData.append('start_date', borrowDateTime);
        formData.append('end_date', returnDateTime);
        formData.append('deskripsi_keperluan', reason);
        formData.append('jaminan', document.querySelector('#image').files[0]);
        formData.append('items', JSON.stringify(checkoutItems));


          $.ajax({
            url: '/inventory/peminjaman',
            method: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                $(document).ready(function() {
                    $('.detail-item-modal-container').addClass('d-none');
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

    function showValidationError(message) {
        $('.modal-container-failed').removeClass('d-none');
        $('#modal-container-failed-title').html('Gagal');
        $('#modal-container-failed-message').html(message);
    }
</script>
