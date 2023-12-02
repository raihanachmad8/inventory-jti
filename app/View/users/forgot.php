
    <h1>Forgot</h1>
    <form action="/users/forgot" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $_POST['email'] ?? ''?>" required>
        <?php if (isset($model['error']['email'])) {
            echo '<p style="color: red;"> '. $model['error']['email'][0] . '</p>';
        } ?>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="/">home</a>
    <a href="/users/register">register</a>
