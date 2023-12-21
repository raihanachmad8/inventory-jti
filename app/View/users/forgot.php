<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="/public/assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .login-content {
            width: 100vw;
            height: 100vh;
            background: #fff;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        #content {
            max-height: 30rem;
            width: 100vw;
            display: inline-grid;
            grid-template-rows: auto 1fr auto;
        }

        @media screen and (min-width: 992px) {
            .login-content {
                width: 60vw;
                height: 75vh;
                background: #fff;
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            #content {
                max-height: 30rem;
                width: 100%;
                display: inline-grid;
                grid-template-rows: auto auto 1fr auto;
            }
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="login-content rounded-4 overflow-hidden d-flex align-items-center shadow justify-content-center bg-body-tertiary">
            <div class="w-100 h-100 d-none d-lg-inline-block position-relative">
                <div class="w-100 h-100 position-absolute p-3 d-flex align-items-end bg-black bg-opacity-25 ">
                    <div class="p-3 bg-body rounded-3">
                        <strong>Inventaris</strong>
                        <p>Inventaris adalah daftar atau catatan rinci yang mencakup semua barang, aset, atau benda yang dimiliki, disimpan, atau digunakan oleh suatu organisasi, perusahaan, atau individu pada suatu waktu tertentu.</p>
                    </div>
                </div>
                <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 h-100 object-fit-cover">
            </div>
            <div id="content" class="h-100 align-items-center justify-content-center align-self-center p-4 ">
                <div class="d-flex justify-content-start align-items-center py-3 column-gap-1" >
                    <i data-feather="chevron-left"></i>
                    Kembali
                </div>
                <div class="text-center ">
                    <strong style="font-size: 1.5rem;">Masukan alamat email</strong>
                    <p class="text-center">Masukkan alamat email untuk mendapatkan kode verifikasi</p>
                </div>
                <form action="/users/forgot" method="post" class="w-100 ">
                    <div class="d-flex flex-column">
                        <label for="email" class="mb-1 fw-bold ">Email</label>
                        <input type="email" id="email" value="<?= $_POST['email'] ?? '' ?>" required name="email" placeholder="Email" class="px-3 py-2  rounded-3 " style="border: 1px solid #023670;">
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
                    <input type="submit" value="Kirim tautan ke Email" class="btn rounded-3 mt-3  w-100 text-white" style="background-color: #023670;"></input>
                </form>
                <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 ">
                    <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                    <small>Politeknik Negeri Malang</small>
                </div>
            </div>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
</body>

</html>