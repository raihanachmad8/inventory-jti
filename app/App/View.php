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
            View::render404(null, "Page not found");
        }
    }

    public static function renderPage(string $page): void
    {
        $viewPath = __DIR__ . '/../View/' . $page . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            View::render404(null, "Page not found");
        }
    }

    public static function render404($path = null, $message = null) {
        $path404 =  __DIR__ . '/../View/' . ($path ?? '404') . '.php';
            if (file_exists($path404)) {
                require_once $path404;
                http_response_code(404);
                exit();
            } else {
                http_response_code(404);
                echo "404 Not Found";
                exit();
            }
    }

    public static function render500($path = null, $message = null) {
        $path500 =  __DIR__ . '/../View/' . ($path ?? '500') . '.php';
            if (file_exists($path500)) {
                require_once $path500;
                http_response_code(500);
                exit();
            } else {
                http_response_code(500);
                echo "500 Internal Server Error";
                exit();
            }
    }

    public function render403($path = null, $message = null) {
        $path403 =  __DIR__ . '/../View/' . ($path ?? '403') . '.php';
            if (file_exists($path403)) {
                require_once $path403;
                http_response_code(403);
                exit();
            } else {
                http_response_code(403);
                echo "403 Forbidden";
                exit();
            }
    }

    public function render401($path = null, $message = null) {
        $path401 =  __DIR__ . '/../View/' . ($path ?? '401') . '.php';
            if (file_exists($path401)) {
                require_once $path401;
                http_response_code(401);
                exit();
            } else {
                http_response_code(401);
                echo "401 Unauthorized";
                exit();
            }
    }

    public static function render(array $view = [
        'header' => 'header',
        'view' => 'view',
        'footer' => 'footer'
    ], array $model = []): void
    {
        $viewPath = __DIR__ . '/../View/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once __DIR__ . '/../View/' . $view['header'] . '.php';
            require_once __DIR__ . '/../View/' . $view['view'] . '.php';
            require_once __DIR__ . '/../View/' . $view['footer'] . '.php';
        } else {
            View::render404(null, "Page not found");
        }
    }



    public static function redirect(string $url, array $model = [])
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }

    public static function setFlashData(string $key,string $message)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $message;
        session_write_close();
    }

    public static function getFlashData() {
        session_start();

        if (isset($_SESSION['error'])) {
            $errorMessage = $_SESSION['error'];
            echo '<div style="background-color: #ffcccc; padding: 10px;">' . $errorMessage . '</div>';
            unset($_SESSION['error']);
        } else if (isset($_SESSION['success'])) {
            $successMessage = $_SESSION['success'];
            echo '<div style="background-color: green; padding: 10px;">' . $successMessage . '</div>';
            unset($_SESSION['success']);
        }

        session_write_close();
    }

}
