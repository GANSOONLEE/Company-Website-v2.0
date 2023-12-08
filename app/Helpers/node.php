<?php

if (!function_exists('node')) {
    function node(string $nodeName): \App\Node\AbstractNode
    {

        $nodeClass = 'App\\Node\\' . str_replace('.', '\\', $nodeName);

        return app($nodeClass);
    }
}