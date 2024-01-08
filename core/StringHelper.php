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

    function getBetween($string, $start, $end): string
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}