<?php

namespace app\core;

class StringHelper
{
    public function getBefore(string $string, string $substring)
    {
        $position = strpos($string, $substring);
        if($position !== false){
            return substr($string, 0, $position);
        }
        return $string;
    }
}