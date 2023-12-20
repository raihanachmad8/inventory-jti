<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .register-content {
            width: 100vw;
            height: 100vh;
            background: #fff;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .duration-300 {
            transition-duration: 300ms;
        }

        .content-container {
            width: 100vw;
            height: 100vh;
        }

        #content1,
        #content2,
        #content3 {
            max-height: 30rem;
            width: 100vw;
            display: inline-grid;
            grid-template-rows: auto 1fr auto;
        }

        @media screen and (min-width: 992px) {
            .register-content {
                width: 60vw;
                height: 75vh;
                background: #fff;
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            #content1,
            #content2,
            #content3,
            .content-container {
                max-height: 30rem;
                width: 100%;
                display: inline-grid;
                grid-template-rows: auto 1fr auto;
            }
        }
    </style>

</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center ">
        <div class="register-content border rounded-3 overflow-hidden shadow position-relative">
            <a href="/" class="position-absolute top-0 end-0 p-3 link-body-emphasis "><i data-feather="x" style="width: 2.5rem; height: 2.5rem;"></i></a>
            <div class="w-100 h-100 d-none d-lg-inline-block position-relative">
                <div class="w-100 h-100 position-absolute p-3 d-flex align-items-end bg-black bg-opacity-25 ">
                    <div class="p-3 bg-body rounded-3">
                        <strong>Inventaris</strong>
                        <p>Inventaris adalah daftar atau catatan rinci yang mencakup semua barang, aset, atau benda yang dimiliki, disimpan, atau digunakan oleh suatu organisasi, perusahaan, atau individu pada suatu waktu tertentu.</p>
                    </div>
                </div>
                <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 h-100 object-fit-cover">
            </div>
            <form action="/users/register" method="post" class="content-container align-self-center px-4 position-relative d-flex align-items-center justify-content-center  overflow-hidden">
                <div id="content1" class=" align-items-center justify-content-center align-self-center position-absolute start-0 " style="transition: transform 300ms ease;"><?php if (isset($model['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $model['error'] ?>
                    </div>
                <?php endif; ?>
                    <strong class="text-center py-4" style="font-size: 1.5rem; color: #022f63">Pilih role anda</strong>
                    <div style="display: grid; grid-template-rows:1fr auto; gap: 3rem;">
                        <div class="d-flex justify-content-center align-items-center column-gap-3 ">
                            <input type="radio" name="role" id="mahasiswa" value="Mahasiswa" class="d-none ">
                            <input type="radio" name="role" id="dosen" value="Dosen" class="d-none ">
                            <label for="mahasiswa" id="btnMahasiswa" class="btn d-flex flex-column p-3 text-center bg-body-secondary rounded-3 justify-content-center align-items-center " style="width: 6rem;">
                                <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M77.8955 12.958L40.9727 0.164158C40.3411 -0.0547193 39.6582 -0.0547193 39.0266 0.164158L2.10383 12.958C1.49116 13.1703 0.958289 13.5776 0.580701 14.1222C0.203112 14.6669 -4.78545e-05 15.3212 8.45515e-09 15.9925V47.9771C8.45516e-09 48.8254 0.324172 49.6389 0.901202 50.2388C1.47823 50.8386 2.26085 51.1756 3.0769 51.1756C3.89294 51.1756 4.67556 50.8386 5.25259 50.2388C5.82962 49.6389 6.15379 48.8254 6.15379 47.9771V20.4304L19.0729 24.9042C15.6405 30.6687 14.549 37.6135 16.0381 44.2137C17.5272 50.814 21.4752 56.5302 27.0152 60.1072C20.0921 62.9299 14.1076 68.0354 9.73069 75.0161C9.50306 75.3677 9.34494 75.763 9.26554 76.1787C9.18614 76.5945 9.18703 77.0225 9.26816 77.4379C9.34929 77.8533 9.50904 78.2478 9.73813 78.5985C9.96722 78.9491 10.2611 79.249 10.6026 79.4805C10.9442 79.7121 11.3266 79.8708 11.7276 79.9474C12.1287 80.0239 12.5404 80.0169 12.9388 79.9266C13.3372 79.8364 13.7144 79.6647 14.0484 79.4215C14.3824 79.1784 14.6666 78.8687 14.8845 78.5104C20.6806 69.2668 29.8344 63.9694 39.9997 63.9694C50.165 63.9694 59.3187 69.2668 65.1148 78.5104C65.5661 79.2076 66.2632 79.6922 67.0555 79.8594C67.8478 80.0266 68.6715 79.863 69.3486 79.4039C70.0257 78.9448 70.5018 78.2271 70.674 77.406C70.8462 76.5849 70.7005 75.7264 70.2686 75.0161C65.8917 68.0354 59.8841 62.9299 52.9842 60.1072C58.5188 56.5304 62.4631 50.8179 63.9519 44.2224C65.4408 37.627 64.3528 30.687 60.9264 24.9242L77.8955 19.047C78.5083 18.8349 79.0413 18.4276 79.419 17.883C79.7967 17.3383 80 16.6839 80 16.0125C80 15.3411 79.7967 14.6867 79.419 14.1421C79.0413 13.5974 78.5083 13.1902 77.8955 12.978V12.958ZM58.461 38.3817C58.4619 41.4157 57.7707 44.4066 56.4442 47.1091C55.1177 49.8116 53.1937 52.1487 50.8301 53.9286C48.4664 55.7085 45.7305 56.8804 42.8468 57.3483C39.963 57.8162 37.0137 57.5667 34.2407 56.6203C31.4677 55.6738 28.95 54.0574 26.8943 51.9037C24.8387 49.75 23.3035 47.1203 22.4148 44.2304C21.5262 41.3405 21.3093 38.2727 21.7821 35.2788C22.2548 32.2849 23.4037 29.4502 25.1344 27.0072L39.0266 31.8049C39.6582 32.0238 40.3411 32.0238 40.9727 31.8049L54.8649 27.0072C57.2025 30.3016 58.4629 34.2881 58.461 38.3817ZM39.9997 25.416L12.8076 15.9925L39.9997 6.56907L67.1917 15.9925L39.9997 25.416Z" fill="#022f63" />
                                </svg>
                                <small class="mt-2 fw-bold ">Mahasiswa</small>
                            </label>
                            <label for="dosen" id="btnDosen" class="btn d-flex flex-column p-3 text-center bg-body-secondary  rounded-3 justify-content-center align-items-center " style="width: 6rem;">
                                <svg width="50" height="50" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M73.8462 0H6.15385C4.52174 0 2.95649 0.64835 1.80242 1.80242C0.64835 2.95649 0 4.52174 0 6.15385V61.5385C0 63.1706 0.64835 64.7358 1.80242 65.8899C2.95649 67.044 4.52174 67.6923 6.15385 67.6923H11.3038C11.8862 67.6925 12.4566 67.5274 12.9489 67.2163C13.4411 66.9052 13.8349 66.4607 14.0846 65.9346C15.5808 62.7757 17.9431 60.1064 20.8967 58.2372C23.8503 56.368 27.2739 55.3757 30.7692 55.3757C34.2646 55.3757 37.6882 56.368 40.6418 58.2372C43.5953 60.1064 45.9576 62.7757 47.4538 65.9346C47.7035 66.4607 48.0974 66.9052 48.5896 67.2163C49.0819 67.5274 49.6523 67.6925 50.2346 67.6923H73.8462C75.4783 67.6923 77.0435 67.044 78.1976 65.8899C79.3517 64.7358 80 63.1706 80 61.5385V6.15385C80 4.52174 79.3517 2.95649 78.1976 1.80242C77.0435 0.64835 75.4783 0 73.8462 0ZM21.5385 40C21.5385 38.1743 22.0798 36.3897 23.0941 34.8717C24.1084 33.3537 25.5501 32.1705 27.2368 31.4719C28.9235 30.7732 30.7795 30.5904 32.5701 30.9466C34.3607 31.3028 36.0054 32.1819 37.2964 33.4729C38.5873 34.7638 39.4665 36.4086 39.8226 38.1992C40.1788 39.9898 39.996 41.8458 39.2974 43.5325C38.5987 45.2192 37.4156 46.6608 35.8976 47.6751C34.3796 48.6894 32.5949 49.2308 30.7692 49.2308C28.3211 49.2308 25.9732 48.2582 24.2421 46.5271C22.511 44.796 21.5385 42.4482 21.5385 40ZM73.8462 61.5385H52.0885C49.519 57.1209 45.6458 53.6063 41 51.4769C43.3292 49.403 44.9731 46.6701 45.7137 43.6407C46.4544 40.6112 46.2568 37.4282 45.1472 34.5135C44.0377 31.5989 42.0685 29.0903 39.5007 27.3203C36.933 25.5502 33.8879 24.6024 30.7692 24.6024C27.6505 24.6024 24.6055 25.5502 22.0377 27.3203C19.47 29.0903 17.5008 31.5989 16.3912 34.5135C15.2817 37.4282 15.0841 40.6112 15.8248 43.6407C16.5654 46.6701 18.2093 49.403 20.5385 51.4769C15.8927 53.6063 12.0195 57.1209 9.45 61.5385H6.15385V6.15385H73.8462V61.5385ZM12.3077 21.5385V15.3846C12.3077 14.5686 12.6319 13.7859 13.2089 13.2089C13.7859 12.6319 14.5686 12.3077 15.3846 12.3077H64.6154C65.4314 12.3077 66.2141 12.6319 66.7911 13.2089C67.3681 13.7859 67.6923 14.5686 67.6923 15.3846V52.3077C67.6923 53.1237 67.3681 53.9064 66.7911 54.4834C66.2141 55.0604 65.4314 55.3846 64.6154 55.3846H58.4615C57.6455 55.3846 56.8629 55.0604 56.2858 54.4834C55.7088 53.9064 55.3846 53.1237 55.3846 52.3077C55.3846 51.4916 55.7088 50.709 56.2858 50.132C56.8629 49.5549 57.6455 49.2308 58.4615 49.2308H61.5385V18.4615H18.4615V21.5385C18.4615 22.3545 18.1374 23.1371 17.5603 23.7142C16.9833 24.2912 16.2007 24.6154 15.3846 24.6154C14.5686 24.6154 13.7859 24.2912 13.2089 23.7142C12.6319 23.1371 12.3077 22.3545 12.3077 21.5385Z" fill="#022f63" />
                                </svg>
                                <small class="mt-2 fw-bold ">Dosen</small>
                            </label>
                        </div>
                        <small class="text-center">Sudah punya akun? <a href="/users/login" class="fw-bold" style="color: #022f63;">Login</a></small>
                        <button type="button" class="btn rounded-3 w-100 text-white mt-3" id="lanjutkan_button1" style="background-color: #023670;">Lanjutkan</button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 ">
                        <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                        <small>Politeknik Negeri Malang</small>
                    </div>
                </div>
                <div id="content2" class="px-3 bg-white align-self-center position-absolute start-0" style="transform: translateX(100%); transition: transform 300ms ease;">
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="button_kembali1" class="btn px-0" style="color: #022f63">
                            < Kembali </button>
                                <strong class="text-center py-4" style="font-size: 1.5rem; color: #022f63">Daftar</strong>
                    </div>
                    <div style="display: grid; grid-template-rows:1fr; gap: 3rem;">
                        <div>
                            <div class="mt-2">
                                <label for="nomor-identitas">Nomor Identitas</label>
                                <input type="number" id="nomor-identitas" name="nomor-identitas" placeholder="NIM / NIP" class="form-control  " style="border: 1px solid #022f63 !important;">
                                <?php if (isset($model['errors']['Nomor_Identitas'])) : ?>
                                <small class="text-danger">
                                    <?php if (is_array($model['errors']['Nomor_Identitas'])) : ?>
                                        <div><?= $model['errors']['Nomor_Identitas'][0] ?></div>
                                    <?php else : ?>
                                        <?= $model['errors']['Nomor_Identitas'] ?>
                                    <?php endif; ?>
                                </small>
                            <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="John Doe" style="border: 1px solid #022f63 !important;">
                                <?php if (isset($model['errors']['Nama'])) : ?>
                            <small class="text-danger">
                                <?php if (is_array($model['errors']['Nama'])) : ?>
                                    <div><?= $model['errors']['Nama'][0] ?></div>
                                <?php else : ?>
                                    <?= $model['errors']['Nama'] ?>
                                <?php endif; ?>
                            </small>
                        <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <label class="sr-only" for="nomor-telepon">Nomor Telepon</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text rounded-0 rounded-start-3" style="border: 1px solid #022f63 !important;">+62</div>
                                    </div>
                                    <input type="number" class="form-control" id="nomor-telepon" name="nomor-telepon" placeholder="89xxxxxxx" style="border: 1px solid #022f63 !important;">
                                </div>
                                <?php if (isset($model['errors']['Nomor_HP'])) : ?>
                                    <small class="text-danger">
                                        <?php if (is_array($model['errors']['Nomor_HP'])) : ?>
                                            <div><?= $model['errors']['Nomor_HP'][0] ?></div>
                                        <?php else : ?>
                                            <?= $model['errors']['Nomor_HP'] ?>
                                        <?php endif; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn rounded-3 w-100 text-white mt-3" id="lanjutkan_button2" style="background-color: #023670;">Lanjutkan</button>
                    <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 ">
                        <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                        <small>Politeknik Negeri Malang</small>
                    </div>
                </div>
                <div id="content3" class="bg-white px-3 align-self-center position-absolute start-0" style="transform: translateX(100%); transition: transform 300ms ease;">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" id="button_kembali2" class="btn px-0" style="color: #022f63">
                            < Kembali </button>
                                <strong class=" text-center py-4" style="font-size: 1.5rem; color: #022f63">Daftar</strong>
                    </div>
                    <div style="display: grid; grid-template-rows:1fr; gap: 3rem;">
                        <div>
                            <div class="mt-2">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="email" class="form-control  " style="border: 1px solid #022f63 !important;">
                                <?php if (isset($model['errors']['Email'])) : ?>
                                <small class="text-danger">
                                    <?php if (is_array($model['errors']['Email'])) : ?>
                                        <div><?= $model['errors']['Email'][0] ?></div>
                                    <?php else : ?>
                                        <?= $model['errors']['Email'] ?>
                                    <?php endif; ?>
                                </small>
                            <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <label for="password">password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="********" style="border: 1px solid #022f63 !important;">
                                <?php if (isset($model['errors']['Password'])) : ?>
                                    <small class="text-danger">
                                        <?php if (is_array($model['errors']['Password'])) : ?>
                                            <div><?= $model['errors']['Password'][0] ?></div>
                                        <?php else : ?>
                                            <?= $model['errors']['Password'] ?>
                                        <?php endif; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <label for="confirm-password">Konfirmasi password</label>
                                <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="********" style="border: 1px solid #022f63 !important;">
                                <?php if (isset($model['errors']['Password'])) : ?>
                                    <small class="text-danger">
                                        <?php if (is_array($model['errors']['Password'])) : ?>
                                            <div><?= $model['errors']['Password'][0] ?></div>
                                        <?php else : ?>
                                            <?= $model['errors']['Password'] ?>
                                        <?php endif; ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <a href="/users/register/verification">
                        <button type="submit" class="btn rounded-3 w-100 text-white mt-3 duration-300" id="lanjutkan_button3" style="background-color: #023670;">Daftar</button>
                    </a>
                    <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 duration-300">
                        <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                        <small>Politeknik Negeri Malang</small>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $('#lanjutkan_button1').prop('disabled', true);
            $(document).on('click', '#lanjutkan_button1', () => {
                $('#content1').css('transform', 'translateX(100%)');
                $('#content2').css('transform', 'translateX(0)');
            });

            $(document).on('click', '#lanjutkan_button2', () => {
                if ($('#nomor-telepon').val() != '' && $('#nama').val() != '' && $('#Nomor_Identitas').val() != '') {
                    $('#content2').css('transform', 'translateX(100%)');
                    $('#content3').css('transform', 'translateX(0)');
                } else {
                    if ($(`.alert-danger`).length == 0) {
                        $('#content').children(':nth-child(2)').before(`<div class="alert alert-danger alert-dismissible fade show" role="alert"> Mohon isi semua data terlebih dahulu <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`)
                    }
                }
            })

            // $(document).on('click', '#lanjutkan_button3', (e) => {
            //     if ($('#email').val() != '' && $('#password').val() != '' && $('#confirm_password').val() != '') {
            //         if (formData.has('email')) {
            //             formData.set('email', $('#email').val())
            //         } else {
            //             formData.append('email', $('#email').val())
            //         }

            //         if (formData.has('password')) {
            //             formData.set('password', $('#password').val())
            //         } else {
            //             formData.append('password', $('#password').val())
            //         }

            //         if (formData.has('confirm_password')) {
            //             formData.set('confirm_password', $('#confirm_password').val())
            //         } else {
            //             formData.append('confirm_password', $('#confirm-password').val())
            //         }
            //     } else {
            //         if ($(`.alert-danger`).length == 0) {
            //             $('#content').children(':nth-child(2)').before(`<div class="alert alert-danger alert-dismissible fade show" role="alert"> Mohon isi semua data terlebih dahulu <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`)
            //         }
            //     }
            // })



            $(document).on('click', '#button_kembali1', () => {
                $('#content1').css('transform', 'translateX(0)');
                $('#content2').css('transform', 'translateX(100%)');
            })

            $(document).on('click', '#button_kembali2', () => {
                $('#content2').css('transform', 'translateX(0)');
                $('#content3').css('transform', 'translateX(100%)');
            })
        })

        $("#btnMahasiswa").click(function() {
            toggleButtonState($(this), $("#btnDosen"));
            $('#lanjutkan_button1').prop('disabled', false);
        });

        // Tambahkan event listener untuk menangani klik pada button Dosen
        $("#btnDosen").click(function() {
            toggleButtonState($(this), $("#btnMahasiswa"));
            $('#lanjutkan_button1').prop('disabled', false);
        });

        // Fungsi untuk mengganti status button seperti checkbox
        function toggleButtonState(button1, button2) {
            // Cek apakah button memiliki class 'active'
            if (button1.hasClass('active') && !(button2.hasClass('active'))) {
                // Jika iya, hapus class 'active' dan ubah teks menjadi normal
                button1.removeClass('active');
                button1.find('strong').css('font-weight', 'normal');
                button2.addClass('active');
                button2.find('strong').css('font-weight', 'bold');
            } else {
                // Jika tidak, tambahkan class 'active' dan ubah teks menjadi tebal
                button1.addClass('active');
                button1.find('strong').css('font-weight', 'bold');
                button2.removeClass('active');
                button2.find('strong').css('font-weight', 'normal');
            }
        }
    </script>
    <script>
        feather.replace();
    </script>
</body>

</html>
