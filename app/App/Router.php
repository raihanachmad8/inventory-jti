<?php

interface RouterInterface {
    public static function run(): void;
    public static function route(string $method, string $path, array $controller, array $middleware = []): void;
    public static function get(string $path, array $controller, array $middleware = []): void;
    public static function post(string $path, array $controller, array $middleware = []): void;
    public static function put(string $path, array $controller, array $middleware = []): void;
    public static function delete(string $path, array $controller, array $middleware = []): void;
    public static function patch(string $path, array $controller, array $middleware = []): void;
}

class Router implements RouterInterface
{
    public static array $routes = [];
    public static array $globalMiddleware = [];

    public static function addGlobalMiddleware(string $middleware): void
    {
        self::$globalMiddleware[] = $middleware;
    }

    public static function run(): void
    {
        $originalPath = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $originalPath = $_SERVER['PATH_INFO'];
        }

        $path = rtrim($originalPath, '/');

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route['path'] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {

                // Call global middleware
                foreach (self::$globalMiddleware as $middleware){
                    $instance = new $middleware;
                    $instance->before();
                };

                //     // Call middleware
                    foreach ($route['middleware'] as $middleware){
                            $instance = new $middleware;
                            $instance->before();
                        };

                $function = $route['function'];
                $controller = new $route['controller'];
                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);

            return;
            }
        }

        View::renderView('404');
    }


    public static function route(string $method, string $path, array $controller, array $middleware = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller[0],
            'function' => $controller[1],
            'middleware' => $middleware
        ];
    }

    public static function get(string $path, array $controller, array $middleware = []): void
    {
        self::route('GET', $path, $controller, $middleware);
    }

    public static function post(string $path, array $controller, array $middleware = []): void
    {
        self::route('POST', $path, $controller, $middleware);
    }

    public static function put(string $path, array $controller, array $middleware = []): void
    {
        self::route('PUT', $path, $controller, $middleware);
    }

    public static function delete(string $path, array $controller, array $middleware = []): void
    {
        self::route('DELETE', $path, $controller, $middleware);
    }

    public static function patch(string $path, array $controller, array $middleware = []): void
    {
        self::route('PATCH', $path, $controller, $middleware);
    }
}
