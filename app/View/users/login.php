
    <h1>Login</h1>
    <form action="/users/login" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $_POST['email'] ?? ''?>" required>
        <?php
            if (isset($model['error']['email'])) {
                if (is_array($model['error']['email'])) {
                    echo '<p style="color: red;"> '. $model['error']['email'][0] . '</p>';
                } else {
                    echo '<p style="color: red;"> '. $model['error']['email'] . '</p>';
                }
            }
            ?>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <?php
            if (isset($model['error']['password'])) {
                if (is_array($model['error']['password'])) {
                    echo '<p style="color: red;"> '. $model['error']['password'][0] . '</p>';
                } else {
                    echo '<p style="color: red;"> '. $model['error']['password'] . '</p>';
                }
            }
            ?>

        <input type="submit" value="Login">
    </form>
    <br>
    <a href="/">home</a>
    <a href="/users/forgot">forgot</a>
    <a href="/users/register">register</a>
