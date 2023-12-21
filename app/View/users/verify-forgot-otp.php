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
        <div class="login-card rounded-4 overflow-hidden shadow d-flex justify-content-center bg-body-tertiary">
            <div class="flex-grow-1 w-100 h-100 d-none d-lg-block">
                <img src="/public/assets/images/putra.jpg" alt="" class="w-100 h-100 object-fit-cover " style="object-position: bottom;">
            </div>
            <div class="flex-grow-1 w-100 h-100" style="display: grid; grid-template-columns: 1fr; grid-template-rows: auto auto;">
                <div class="d-flex flex-column justify-content-center align-items-center px-4 h-100 ">
                    <div style="width: 4rem; height: 4rem">
                        <img src="/public/assets/images/OTP verification.svg" alt="" class="w-100 h-100">
                    </div>
                    <div class="text-center">
                        <strong>Masukkan kode verifikasi</strong>
                        <p class="text-center">Kode verifikasi sudah dikirim melalui email <?= substr(urldecode($_GET['Email']), 0, 3) . '***@' . substr(urldecode($_GET['Email']), strpos(urldecode($_GET['Email']), '@') + 1)?></p>
                    </div>
                </div>
                <div class="d-flex flex-column  justify-content-between align-items-center py-4 h-100">
                    <form method="post" class="px-4 d-flex flex-column justify-content-between ">
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                            <input type="number" name="code_1" id="code_1" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                            <input type="number" name="code_2" id="code_2" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                            <input type="number" name="code_3" id="code_3" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                            <input type="number" name="code_4" id="code_4" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                            <input type="number" name="code_5" id="code_5" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                            <input type="number" name="code_6" id="code_6" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 3rem; height: 3rem; border: 1px solid #023670; border-radius: 10px; text-align: center;">
                        </div>
                        <small class="text-center pt-3  ">Tidak menerima kode verifikasi? <strong class="countdown" style="color: #022f63;"></strong></small>
                        <button type="submit" class="btn w-100 mt-3" style="background-color: #023670; color: white;">Verifikasi</button>
                    </form>
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="/public/assets/images/Logo Polinema (Politeknik Negeri Malang) 1.svg" alt="" style="width: 2rem; height: 2rem">
                        <small>Polinema</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function clearInput(input) {
            input.value = "";
        }

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
                    countdownElement.innerHTML = `<a href="/users/forgot/resend-verification?ID_Pengguna=${id}&Email=${email}">Kirim ulang</a>`
                }
            }

            // Memanggil fungsi updateCountdown setiap detik
            let countdownInterval = setInterval(updateCountdown, 1000);
        }
    window.onload = startCountdown;
    </script>
</body>

</html>

