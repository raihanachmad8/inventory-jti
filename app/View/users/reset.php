<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php View::getFlashData();?>

<h1>New Password</h1>
<form action="/users/forgot/reset?ID_Pengguna=<?= $_GET['ID_Pengguna'] ?>&Email=<?= $_GET['Email']?>" method="post">

    <label for="Password">Password</label>
    <input type="Password" name="Password" id="Password" required>

    <label for="Confirm_Password">Confirm Password</label>
    <input type="Password" name="Confirm_Password" id="Confirm_Password" required>
    <?php if (isset($model['error']['Password'][0])): ?>
        <p><?= $model['error']['Password'][0] ?></p>
    <?php endif; ?>
    <br>
    <input type="submit" value="Confirm">
</form>
<a href="/">home</a>
<a href="/users/login">login</a>

</body>
</html>
