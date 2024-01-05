<?php
namespace app\core\request;

use app\core\StringHelper;

class AppRequest implements Request
{   
    private $stringHelper;

    public function __construct(StringHelper $stringHelper)
    {
        $this->stringHelper = $stringHelper;
    }
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?: '/';
        return $this->stringHelper->getBefore($path, '?');
    }
    
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }    
}