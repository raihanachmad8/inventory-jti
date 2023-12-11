<?php
$current_page_url = $_SERVER['REQUEST_URI'];



$menu_items = [
    'admin' => '/admin',
    'admin/data-peminjaman' => '/admin/data-peminjaman',
    'admin/inventarisir' => '/admin/inventarisir',
    'admin/riwayat-peminjaman' => '/admin/riwayat-peminjaman',
    'admin/maintainer' => '/admin/maintainer',
    'dashboard' => '/inventory/dashboard',
    'peminjaman' => '/inventory/peminjaman',
    'riwayat' => '/inventory/riwayat',
    'profil' => '/profile/profil',
    'keamanan' => '/profile/keamanan',
    'pesan' => '/profile/pesan',
    'hapus-akun' => '/profile/hapus-akun',
];

function active_page($current_page, $target)
{
    return $current_page === $target;
}

function user_role()
{
    $parsed_url = parse_url($_SERVER['REQUEST_URI']);
    $path = explode('/', trim($parsed_url['path'], '/'));
    return in_array('admin', $path) ? 'admin' : 'user';
}

?>    
    
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


    