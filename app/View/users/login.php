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
        <div class="login-content border rounded-3 overflow-hidden shadow">
            <div class="w-100 h-100 d-none d-lg-inline-block position-relative">
                <div class="w-100 h-100 position-absolute p-3 d-flex align-items-end bg-black bg-opacity-25 ">
                    <div class="p-3 bg-body rounded-3">
                        <strong>Inventaris</strong>
                        <p>Inventaris adalah daftar atau catatan rinci yang mencakup semua barang, aset, atau benda yang dimiliki, disimpan, atau digunakan oleh suatu organisasi, perusahaan, atau individu pada suatu waktu tertentu.</p>
                    </div>
                </div>
                <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 h-100 object-fit-cover">
            </div>
            <div id="content" class=" h-100 align-items-center justify-content-center align-self-center px-4 ">
                <strong class="text-center py-4" style="font-size: 1.5rem; color: #022f63">Masuk</strong>
                <?php if (isset($model['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $model['error'] ?>
                        </div>
                    <?php endif; ?>
                <form action="/users/login" method="post" enctype="multipart/form-data" style="display: grid; grid-template-rows:1fr 1fr; gap: 10px;">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Masukkan email" class="form-control" style="border: 1px solid #022f63 !important;" />
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
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="********" class="form-control" value="" style="border: 1px solid #022f63 !important;" />
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
                    <a href="" class="link-body-emphasis link-underline-opacity-0 link-underline-light link-underline-opacity-100-hover text-end " style="font-size: 0.8rem">Lupa Password</a>
                    <button class="btn " style="background: #022f63; color: #fff; width: 100%;" type="submit">Masuk</button>
                    <small class="text-center">Belum punya akun? <a href="/users/register" class="fw-bold" style="color: #022f63;">Daftar</a></small>
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
