<?php

if (!function_exists('url_encode')) {
    function url_encode($url) {

        $encodeArray = [
            (object)[
                "detect" => '%2F',
                "convertTo" => '/',
            ],
            (object)[
                "detect" => '%5C',
                "convertTo" => '\\',
            ],
            (object)[
                "detect" => '%3F',
                "convertTo" => '?',
            ],
            (object)[
                "detect" => '+',
                "convertTo" => '%20',
            ],
        ];

        $encodeUrl = urlencode($url);
        $encodedUrl = $encodeUrl;

        foreach ($encodeArray as $encode) {
            $encodedUrl = str_replace($encode->detect, $encode->convertTo, $encodedUrl);
        };

        return  $encodedUrl;
        
    };
};

if (!function_exists('file_path_encode')) {
    function file_path_encode($url) {

        $encodeArray = [
            (object)[
                "detect" => '%5C',
                "convertTo" => '-',
            ],
            (object)[
                "detect" => '%2F',
                "convertTo" => '-',
            ],
            (object)[
                "detect" => '\\',
                "convertTo" => '-',
            ],
            (object)[
                "detect" => '+',
                "convertTo" => ' ',
            ],
        ];

        $encodeUrl = urlencode($url);
        $encodedUrl = $encodeUrl;

        foreach ($encodeArray as $encode) {
            $encodedUrl = str_replace($encode->detect, $encode->convertTo, $encodedUrl);
        };

        return  $encodedUrl;
        
    };
};