

    <h1>Register</h1>

    <form action="/users/register" method="post">
        <label for="nomor_identitas">Nomor Identitas</label>
        <input type="text" name="nomor_identitas" id="nomor_identitas" value="<?= $_POST['nomor_identitas'] ?? ''?>" required>
        <?php if (isset($model['error']['nomor_identitas'][0])): ?>
            <p><?= $model['error']['nomor_identitas'][0] ?></p>
        <?php endif; ?>
        <br>
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" value="<?= $_POST['nama'] ?? ''?>" required><br>
        <?php if (isset($model['error']['nama'][0])): ?>
            <p><?= $model['error']['nama'][0] ?></p>
        <?php endif; ?>
        <label for="nomor_hp">Nomor HP</label>
        <input type="text" name="nomor_hp" id="nomor_hp" value="<?= $_POST['nomor_hp'] ?? ''?>" required><br>
        <?php if (isset($model['error']['nomor_hp'][0])): ?>
            <p><?= $model['error']['nomor_hp'][0] ?></p>
        <?php endif; ?>
        <label for="email">Alamat Email</label>
        <input type="email" name="email" id="email" value="<?= $_POST['email'] ?? ''?>" required>
        <?php if (isset($model['error']['email'][0])): ?>
            <p><?= $model['error']['email'][0] ?></p>
        <?php endif; ?>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <?php if (isset($model['error']['password'][0])): ?>
            <p><?= $model['error']['password'][0] ?></p>
        <?php endif; ?>
        <br>
        <input type="submit" value="Register">
    </form>
    <a href="/">home</a>
    <a href="/users/login">login</a>
