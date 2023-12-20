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
            width: 100vw;
            max-height: 30rem;
        }

        @media only screen and (min-width: 992px) {
            div.login-content {
                width: 60vw;
                height: 75vh;
                background: #fff;
                display: grid;
                grid-template-columns: 1fr 1fr;
                justify-content: center;
                align-items: center;
            }

            #content {
                max-height: 30rem;
                width: 100%;
                display: inline-grid;
                grid-template-rows: auto auto 1fr auto auto auto;
            }
        }
    </style>

</head>

<body style="font-family: 'Poppins', sans-serif;">
    <div class="vw-100 vh-100 d-flex justify-content-center align-items-center ">
        <div class="login-content border rounded-3 overflow-hidden shadow">
            <div class="w-100 h-100 d-none d-lg-block position-relative">
                <div class="w-100 h-100 position-absolute p-3 d-flex align-items-end bg-black bg-opacity-25 ">
                    <div class="p-3 bg-body rounded-3">
                        <strong>Inventaris</strong>
                        <p>Inventaris adalah daftar atau catatan rinci yang mencakup semua barang, aset, atau benda yang dimiliki, disimpan, atau digunakan oleh suatu organisasi, perusahaan, atau individu pada suatu waktu tertentu.</p>
                    </div>
                </div>
                <img src="/public/assets/images/gedung-jti.jpg" alt="" class="w-100 h-100 object-fit-cover">
            </div>
            <div id="content" class="h-100 align-items-center justify-content-center align-self-center px-4">
                <!-- <?php if (isset($error)) : ?> -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!-- <?php endif ?> -->
                    <?php View::getFlashData() ?>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="/public/assets/images/OTP verification.svg" alt="" style="width: 8rem; height: 8rem">
                </div>
                <div class="text-center">
                    <strong class="text-center" style="font-size: 1.3rem; color: #022f63">Masukkan Kode Verifikasi</strong>
                    <p class="text-center">Kode verifikasi sudah dikirim melalui email <?= substr(urldecode($_GET['Email']), 0, 3) . '***@' . substr(urldecode($_GET['Email']), strpos(urldecode($_GET['Email']), '@') + 1)?></p>
                </div>
                <form action="/users/register/verification?ID_Pengguna=<?=$_GET['ID_Pengguna']?>&Email=<?=$_GET['Email']?>&o=<?= $_GET['o']?>" method="post" style="display: grid; grid-template-rows:1fr; gap: 3rem; justify-content: center; justify-items: center">
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-2 ">
                        <input type="number" name="code_1" id="code_1" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        <input type="number" name="code_2" id="code_2" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        <input type="number" name="code_3" id="code_3" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        <input type="number" name="code_4" id="code_4" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        <input type="number" name="code_5" id="code_5" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        <input type="number" name="code_6" id="code_6" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                    </div>
                    <small>Tidak menerima kode verifikasi? <strong class="countdown" style="color: #022f63;"></strong></small>
                    <button type="submit" class="btn rounded-3 w-100 text-white mb-3" id="lanjutkan_button1" style="background-color: #023670;">Lanjutkan</button>
                </form>
                <div class="d-flex justify-content-center align-items-center p-2 column-gap-2 ">
                    <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" width="30px" height="30px" alt="">
                    <small>Politeknik Negeri Malang</small>
                </div>
            </div>
        </div>
    </div>

    <script>

        function moveToNextInput(currentInput) {
            if (currentInput.value.length > 1) {
                currentInput.value = currentInput.value.slice(0, 1);
            }
            let maxLength = parseInt(currentInput.getAttribute("maxlength"));
            let nextInput = currentInput.nextElementSibling;

            if (currentInput.value.length >= maxLength) {
                currentInput.blur();

                if (nextInput && nextInput.tagName === "INPUT") {
                    nextInput.value = ""; // Clear the next input
                    nextInput.focus();
                }
            }
        }

        function startCountdown() {
            let seconds = 5;
            let countdownElement = document.querySelector('.countdown');

            function updateCountdown() {
                if (seconds > 0) {
                    console.log(seconds);
                    seconds--;
                    countdownElement.textContent = seconds + ' detik';
                    console.log(countdownElement.textContent);
                } else {
                    clearInterval(countdownInterval);
                    urlParams = new URLSearchParams(window.location.search);
                    const email = urlParams.get('Email') || '';
                    const id = urlParams.get('ID_Pengguna') || '';
                    countdownElement.innerHTML = `<a href="/users/register/resend-verification?ID_Pengguna=${id}&Email=${email}">Kirim ulang</a>`
                }
            }

            // Memanggil fungsi updateCountdown setiap detik
            let countdownInterval = setInterval(updateCountdown, 1000);
        }
    window.onload = startCountdown;


    </script>
</body>

</html>
