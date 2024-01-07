<?php
namespace app\core\response;

interface Response 
{
    public function setStatusCode($code): void;
}