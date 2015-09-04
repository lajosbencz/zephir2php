<?php

namespace Zephir2Php;

class Path
{
    public static function normalize($path) {
        if(substr($path,-1,1) == '/') {
            $path = substr($path, 0, -1);
        }
        return $path;
    }

    public static function directory($path) {
        $path = self::normalize($path);
        return $path;
    }

    public static function append($path) {
        $path = self::normalize($path);
        if(substr($path,0,1) !== '/') {
            $path = '/'.$path;
        }
        return $path;
    }

    public static function file($path) {
        return $path;
    }
}
