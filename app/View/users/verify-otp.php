<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php View::getFlashData();?>


<h1><?= $model['title'] ?? 'Verification Code lo' ?></h1>
<form action="/users/register/verification?ID_Pengguna=<?= $_GET['ID_Pengguna'] ?>&Email=<?= $_GET['Email']?>&o=<?= $_GET['o']?>" method="post">
    <input type="number" name="code_1" id="code_1" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;" >
    <input type="number" name="code_2" id="code_2" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;">
    <input type="number" name="code_3" id="code_3" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;">
    <input type="number" name="code_4" id="code_4" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;">
    <input type="number" name="code_5" id="code_5" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;">
    <input type="number" name="code_6" id="code_6" maxlength="1" pattern="[0-9]" onfocus="clearInput(this)" oninput="moveToNextInput(this)" style="-moz-appearance: textfield; width: 50px;">
    <button type="submit">Send</button>
</form>

<a href="/users/register/resend-verification?ID_Pengguna=<?= $_GET['ID_Pengguna'] ?>&Email=<?= $_GET['Email']?>">Resend OTP</a>

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
</script>

</body>
</html>
