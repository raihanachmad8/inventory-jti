<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php View::getFlashData();?>


    <h1>Register</h1>

    <form action="/users/register" method="post">
        <label for="Nomor_Identitas">Nomor Identitas</label>
        <input type="text" name="Nomor_Identitas" id="Nomor_Identitas" value="<?= $_POST['Nomor_Identitas'] ?? ''?>" required>
        <?php if (isset($model['error']['Nomor_Identitas'])): ?>
            <p><?= is_array($model['error']['Nomor_Identitas']) ? $model['error']['Nomor_Identitas'][0] : $model['error']['Nomor_Identitas'] ?></p>
        <?php endif; ?>
        <br>
        <input type="text" id="Dosen" name="Role" value="Dosen" hidden>
        <label for="Nama">Nama Lengkap</label>
        <input type="text" name="Nama" id="Nama" value="<?= $_POST['Nama'] ?? ''?>" required><br>
        <?php if (isset($model['error']['Nama'])): ?>
            <p><?= is_array($model['error']['Nama']) ? $model['error']['Nama'][0] : $model['error']['Nama']; ?></p>
        <?php endif; ?>
        <label for="Nomor_HP">Nomor HP</label>
        <input type="text" name="Nomor_HP" id="Nomor_HP" value="<?= $_POST['Nomor_HP'] ?? ''?>" required><br>
        <?php if (isset($model['error']['Nomor_HP'])): ?>
            <p><?= is_array($model['error']['Nomor_HP']) ? $model['error']['Nomor_HP'][0] : $model['error']['Nomor_HP']; ?></p>
        <?php endif; ?>
        <label for="Email">Alamat Email</label>
        <input type="email" name="Email" id="Email" value="<?= $_POST['Email'] ?? ''?>" required>
        <?php if (isset($model['error']['Email'])): ?>
            <p><?= is_array($model['error']['Email']) ? $model['error']['Email'][0] : $model['error']['Email'];  ?></p>
        <?php endif; ?>
        <br>
        <label for="Password">Password</label>
        <input type="Password" name="Password" id="Password" required>

        <label for="Confirm_Password">Confirm Password</label>
        <input type="Password" name="Confirm_Password" id="Confirm_Password" required>
        <?php if (isset($model['error']['Password'])): ?>
            <p><?= is_array($model['error']['Password']) ? $model['error']['Password'][0] : $model['error']['Password']; ?></p>
        <?php endif; ?>
        <br>
        <input type="submit" value="Register">
    </form>
    <a href="/">home</a>
    <a href="/users/login">login</a>

    </body>
</html>
