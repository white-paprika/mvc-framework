<?php
namespace app\core\router;

interface Router 
{
    public function get(string $path, $callback): void;
    public function post(string $path, $callback): void;
    public function resolve();
}