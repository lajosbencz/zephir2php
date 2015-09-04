<?php

namespace Zephir2Php;

class Terminal
{
    public static function readline($prompt='') {
        if(PHP_OS == 'WINNT') {
            echo $prompt;
            return stream_get_line(STDIN, 1024, PHP_EOL);
        }
        return readline($prompt);
    }
}
