<?php
namespace app\core\request;

class TestRequest implements Request
{   
    public function getPath(): string
    {
        return '/test';
    }
    
    public function getMethod(): string
    {
        return 'get';
    }    
}