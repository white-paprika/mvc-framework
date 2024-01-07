<?php
namespace app\core\router;

use app\core\request\Request;
use app\core\response\Response;
use app\core\view_service\viewService;

class AppRouter implements Router
{
    public $request;
    public $response;
    private $viewService;
    public $routes = [];

    public function __construct(Request $request, Response $response, viewService $viewService)
    {
        $this->request = $request;
        $this->response = $response;
        $this->viewService = $viewService;
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
            return $this->viewService->renderView($callback);
        } else if ($callback === false) {
            $this->response->setStatusCode('404');
            return $this->viewService->renderNotFound();
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