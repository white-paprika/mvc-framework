<?php
namespace app\core\router;

use app\core\request\Request;

class AppRouter implements Router
{
    public $request;
    public $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }
    
    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            echo '404';
        } else {
            call_user_func($callback);
        }
    }
}