<h1>New Password</h1>
<form action="/users/forgot/reset?id_pengguna=<?= $_GET['id_pengguna'] ?>" method="post">

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
    <?php if (isset($model['error']['password'][0])): ?>
        <p><?= $model['error']['password'][0] ?></p>
    <?php endif; ?>
    <br>
    <input type="submit" value="Confirm">
</form>
<a href="/">home</a>
<a href="/users/login">login</a>
