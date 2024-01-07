<?php

use app\core\request\TestRequest;
use app\core\router\AppRouter;
use app\core\StringHelper;
use app\core\ViewManager;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private $request;
    private $viewManager;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new TestRequest;
        $this->viewManager = new ViewManager(new StringHelper);
    }

    public function testGet()
    {
        $router = new AppRouter($this->request, $this->viewManager);
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
        $router = new AppRouter($this->request, $this->viewManager);
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

    // router->resolve() returns but not echo-es => rewrite resolve tests
    public function testResolveWithValidRoute()
    {
        $router = new AppRouter($this->request, $this->viewManager);
        $router->get('/test', function () {
            echo 'Test route';
        });

        ob_start();
        $router->resolve();
        $output = ob_get_clean();

        $this->assertEquals('Test route', $output);
    }

    public function testResolveWithInvalidRoute()
    {
        $router = new AppRouter($this->request, $this->viewManager);
        $router->get('/not-test-path', function () {
            echo 'Not test!';
        });

        // ob_start();
        $output = $router->resolve();
        // $output = ob_get_clean();

        $this->assertEquals('404', $output);
    }

}
