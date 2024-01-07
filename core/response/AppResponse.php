<?php

namespace app\core\response;

class AppResponse implements Response
{
    public function setStatusCode($code): void
    {
        http_response_code($code);
    }
}