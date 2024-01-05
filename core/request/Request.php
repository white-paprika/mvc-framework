<?php
namespace app\core\request;

interface Request 
{
    public function getPath(): string;
    public function getMethod(): string;
}