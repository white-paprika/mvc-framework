<?php
namespace app\core\router;

use app\core\request\Request;
use app\core\response\Response;
use app\core\ViewManager;

class AppRouter implements Router
{
    public $request;
    public $response;
    private $viewManager;
    public $routes = [];

    public function __construct(Request $request, Response $response, ViewManager $viewManager)
    {
        $this->request = $request;
        $this->response = $response;
        $this->viewManager = $viewManager;
    }

    public function get(string $path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }
    
    public function post(string $path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $callback = $this->getCallback();

        if(is_string($callback)){
            return $this->viewManager->renderView($callback);
        } else if ($callback === false) {
            $this->response->setStatusCode('404');
            return $this->viewManager->renderView('not_found');
        } else {
            return call_user_func($callback);
        }
    }

    private function getCallback()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        return $this->routes[$method][$path] ?? false;
    }
}