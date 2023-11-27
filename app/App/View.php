<?php

interface ViewInterface {
    public static function renderView(string $view, array $model = []): void;
    public static function render(array $view, array $model = []): void;
    public static function redirect(string $url);
}

class View implements ViewInterface
{

    public static function renderView(string $view, array $model = []): void
    {
        $viewPath = __DIR__ . '/../View/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once __DIR__ . '/../View/header.php';
            require_once __DIR__ . '/../View/' . $view . '.php';
            require_once __DIR__ . '/../View/footer.php';
        } else {
            View::render404();
        }
    }

    public static function render404($path = null) {
        $path404 =  __DIR__ . '/../View/' . ($path ?? '404') . '.php';
            if (file_exists($path404)) {
                require_once $path404;
                http_response_code(404);
                exit();
            } else {
                http_response_code(404);
                echo "404";
                exit();
            }
    }

    public static function render(array $view = [
        'header' => 'header',
        'view' => 'view',
        'footer' => 'footer'
    ], array $model = []): void
    {
        require_once __DIR__ . "/../View/" . $view['header'] . ".php";
        require_once __DIR__ . "/../View/" . $view['view'] . ".php";
        require_once __DIR__ . "/../View/" . $view['footer'].".php";
    }



    public static function redirect(string $url)
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }

}
