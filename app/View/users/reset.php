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
                grid-template-rows: auto 1fr auto;
            }
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center ">
        <div class="login-content border rounded-3 overflow-hidden shadow position-relative">
            <a href="/" class="position-absolute top-0 end-0 p-3 link-body-emphasis "><i data-feather="x" style="width: 2.5rem; height: 2.5rem;"></i></a>
            <div class="w-100 h-100 d-none d-lg-inline-block position-relative">
                <div class="w-100 h-100 position-absolute p-3 d-flex align-items-end bg-black bg-opacity-25 ">
                    <div class="p-3 bg-body rounded-3">
                        <strong>INTI</strong>
                        <p>INTI adalah aplikasi manajemen peminjaman dan pengelolaan inventaris di Jurusan Teknologi Informasi dirancang untuk memberikan solusi efektif dalam mengelola aset dan sumber daya yang dimiliki oleh departemen tersebut.</p>
                    </div>
                </div>
                <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 h-100 object-fit-cover">
            </div>
            <div id="content" class=" h-100 align-items-center justify-content-center align-self-center px-4 ">
                <strong class="text-center" style="font-size: 1.5rem;">Buat Password Baru</strong>
                <?php View::getFlashData() ?>
                <?php if (isset($model['error'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $model['error'] ?>
                    </div>
                <?php endif; ?>
                <form action="/users/forgot/reset?ID_Pengguna=<?= $_GET['ID_Pengguna'] ?>&Email=<?= $_GET['Email'] ?>" method="post" class="w-100">
                    <div class="d-flex flex-column ">
                        <label for="password" class="mb-1 fw-bold ">Password</label>
                        <input type="password" id="password" required name="password" placeholder="********" class="px-3 py-2  rounded-3 " style="border: 1px solid #023670;">
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
                    <div class="d-flex flex-column mt-3">
                        <label for="confirm-password" class="mb-1 fw-bold ">Konfirmasi Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="**********" class="px-3 py-2  rounded-3 " style="border: 1px solid #023670;">
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
                    <button type="submit" value="Login" class="btn rounded-3 w-100 text-white mt-3 " style="background-color: #023670;">Perbarui</button>
                </form>
                <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 ">
                    <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                    <small>Politeknik Negeri Malang</small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
