<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php View::getFlashData();?>

    <h1>Login</h1>
    <form action="/users/login" method="post">
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" value="<?= $_POST['Email'] ?? ''?>" required>
        <?php
            if (isset($model['error']['Email'])) {
                if (is_array($model['error']['Email'])) {
                    echo '<p style="color: red;"> '. $model['error']['Email'][0] . '</p>';
                } else {
                    echo '<p style="color: red;"> '. $model['error']['Email'] . '</p>';
                }
            }
            ?>

        <label for="Password">Password</label>
        <input type="Password" name="Password" id="Password" required>
        <?php
            if (isset($model['error']['Password'])) {
                if (is_array($model['error']['Password'])) {
                    echo '<p style="color: red;"> '. $model['error']['Password'][0] . '</p>';
                } else {
                    echo '<p style="color: red;"> '. $model['error']['Password'] . '</p>';
                }
            }
            ?>

        <input type="submit" value="Login">
    </form>
    <br>
    <a href="/">home</a>
    <a href="/users/forgot">forgot</a>
    <a href="/users/register">register</a>

    </body>
</html>
