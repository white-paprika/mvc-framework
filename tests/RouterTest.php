<?php

use app\core\request\TestRequest;
use app\core\router\AppRouter;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private $request;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = new TestRequest;
    }

    public function testGet()
    {
        $router = new AppRouter($this->request);
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
        $router = new AppRouter($this->request);
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

    public function testResolveWithValidRoute()
    {
        $router = new AppRouter($this->request);
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
        $router = new AppRouter($this->request);
        $router->get('/not-test-path', function () {
            echo 'Not test!';
        });

        ob_start();
        $router->resolve();
        $output = ob_get_clean();

        $this->assertEquals('404', $output);
    }

}
