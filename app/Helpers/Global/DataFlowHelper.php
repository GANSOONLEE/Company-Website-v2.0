<?php

if (!function_exists('debug_execution')) {
    function debug_execution() {
        $trace = debug_backtrace();
        $caller = $trace[1];

        mylog("Function: {$caller['function']}" . PHP_EOL);
        mylog("Class: {$caller['class']}" . PHP_EOL);
        mylog("File: {$caller['file']}" . PHP_EOL);
        mylog("Line: {$caller['line']}" . PHP_EOL);
    }

    function mylog($message)
    {
        $message = date("H:i:s") . " - $message - ".PHP_EOL;
        print($message);
        flush();
        ob_flush();
    }
}