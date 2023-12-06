<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php View::getFlashData();?>

    <h1>Forgot</h1>
    <form action="/users/forgot" method="post">
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" value="<?= $_POST['Email'] ?? ''?>" required>
        <?php if (isset($model['error']['Email'])) {
            echo '<p style="color: red;"> '. (is_array($model['error']['Email']) ? $model['error']['Email'][0] : $model['error']['Email']) . '</p>';
        } ?>
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="/">home</a>
    <a href="/users/register">register</a>

    </body>
</html>
