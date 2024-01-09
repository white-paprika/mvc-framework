<?php

use app\core\request\TestRequest;
use app\core\response\AppResponse;
use app\core\router\AppRouter;
use app\core\view_service\TestViewService;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';
define('ROOT_DIRECTORY', dirname(__DIR__));

class RouterTest extends TestCase
{
    private $request;
    private $response;
    private $viewService;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new TestRequest;
        $this->response = new AppResponse;
        $this->viewService = new TestViewService;
    }

    public function testGet()
    {
        $router = new AppRouter($this->request, $this->response, $this->viewService);
        $router->get('/', function(){
            return 'index';
        });
        $this->assertEquals('index', call_user_func($router->routes['get']['/']));

        $router->get('/user', function(){
            return 'user';
        });
        $this->assertEquals('user', call_user_func($router->routes['get']['/user']));

        $router->get('/user/posts', function(){
            return 'user\'s posts';
        });
        $this->assertEquals('user\'s posts', call_user_func($router->routes['get']['/user/posts']));
    }

    public function testPost()
    {
        $router = new AppRouter($this->request, $this->response, $this->viewService);
        $router->post('/', function(){
            return 'post index';
        });
        $this->assertEquals('post index', call_user_func($router->routes['post']['/']));

        $router->post('/user', function(){
            return 'Update user';
        });
        $this->assertEquals('Update user', call_user_func($router->routes['post']['/user']));

        $router->post('/user/posts', function(){
            return 'Add post';
        });
        $this->assertEquals('Add post', call_user_func($router->routes['post']['/user/posts']));
    }

    public function testResolveCallbackValidRoute()
    {
        $router = new AppRouter($this->request, $this->response, $this->viewService);
        $router->get('/test', function () {
            return 'Test route content';
        });

        $output = $router->resolve();

        $this->assertEquals('Test route content', $output);
    }

    public function testResolveViewValidRoute()
    {
        $router = new AppRouter($this->request, $this->response, $this->viewService);
        $router->get('/test', 'test');

        $output = $router->resolve();

        $this->assertEquals($this->viewService->renderView('test'), $output);
    }

    public function testResolveInvalidRoute()
    {
        $router = new AppRouter($this->request, $this->response, $this->viewService);
        $router->get('/not-test-path', function () {
            echo 'Not test!';
        });

        $output = $router->resolve();

        $this->assertEquals($this->viewService->renderView('page404'), $output);
    }

}
