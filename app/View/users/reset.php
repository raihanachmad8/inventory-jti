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
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="login-card rounded-4 overflow-hidden d-flex align-items-center shadow justify-content-center bg-body-tertiary">
            <div class="w-100 h-100 bg-black flex-grow-1 position-relative d-none d-lg-block">
                <div class="position-absolute bg-black bg-opacity-50 w-100 h-100 top-0 "></div>
                <img src="/public/assets/images/putra.jpg" alt="" class="w-100 h-100 object-fit-cover" style="object-position: bottom">
            </div>
            <div class="w-100 h-100 flex-grow-1 d-flex flex-column align-items-center justify-content-lg-center  justify-content-between p-5 ">
                <strong style="font-size: 1.5rem;">Buat Password Baru</strong>
                <form action="/users/login" method="post" class="w-100">
                    <div class="d-flex flex-column ">
                        <label for="email" class="mb-1 fw-bold ">Password</label>
                        <input type="password" id="email" required name="email" placeholder="********" class="px-3 py-2  rounded-3 " style="border: 1px solid #023670;">
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <label for="password" class="mb-1 fw-bold ">Password</label>
                        <input type="password" id="password" name="password" placeholder="**********" class="px-3 py-2  rounded-3 " style="border: 1px solid #023670;">
                    </div>
                    <button type="submit" value="Login" class="btn rounded-3 w-100 text-white mt-3 " style="background-color: #023670;">Perbarui</button>
                </form>
                <div class="p-3 d-flex column-gap-2  align-items-center">
                    <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" alt="" style="width: 2rem; height: 2rem;">
                    <small style="color: #023670;">Polinema</small>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<!-- <h1>New Password</h1>
<form action="/users/forgot/reset?id_pengguna=<?= $_GET['id_pengguna'] ?>" method="post">

    <label for="Password">Password</label>
    <input type="Password" name="Password" id="Password" required>

    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
    <?php if (isset($model['error']['password'][0])) : ?>
        <p><?= $model['error']['password'][0] ?></p>
    <?php endif; ?>
    <br>
    <input type="submit" value="Confirm">
</form>
<a href="/">home</a>
<a href="/users/login">login</a> -->
