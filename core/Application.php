<?php
namespace app\core;

use app\core\router\Router;

class Application 
{
    public $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $this->router->resolve();
    }
}