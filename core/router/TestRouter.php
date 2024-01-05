<?php
namespace app\core\router;

use app\core\request\Request;

class TestRouter implements Router
{
    public $routes = [];

    public function get(string $path, $callback): void
    {
        
    }
    
    public function post(string $path, $callback): void
    {
        
    }

    public function resolve(): void
    {
        
    }
}