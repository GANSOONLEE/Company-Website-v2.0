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

if (!function_exists('url_decode')) {
    function url_decode($url) {

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
                "detect" => ' ',
                "convertTo" => '%20',
            ],
        ];

        $encodeUrl = urlencode($url);
        $encodedUrl = $encodeUrl;

        foreach ($encodeArray as $encode) {
            $encodedUrl = str_replace($encode->convertTo, $encode->detect, $encodedUrl);
        };

        return  $encodedUrl;
        
    };
};

/**
 * Convert the invalid symbols to valid symbols
 * @param string $name
 * 
 * @return string
 */
if(!function_exists('path_encode'))
{
    function path_encode(string $name): string
    {

        $encodeArray = [
            (object)[
                "decode" => '\\',
                "encode" => '%1',
            ],
            (object)[
                "decode" => '/',
                "encode" => '%2',
            ],
            (object)[
                "decode" => ':',
                "encode" => '%3',
            ],
            (object)[
                "decode" => '*',
                "encode" => '%4',
            ],
            (object)[
                "decode" => '?',
                "encode" => '%5',
            ],
            (object)[
                "decode" => '"',
                "encode" => '%6',
            ],
            (object)[
                "decode" => '<',
                "encode" => '%7',
            ],
            (object)[
                "decode" => '>',
                "encode" => '%8',
            ],
            (object)[
                "decode" => '|',
                "encode" => '%9',
            ],
        ];

        $encodedName = $name;
        foreach ($encodeArray as $array) {
            $encodedName = str_replace($array->decode, $array->encode, $encodedName);
        };
        
        return $encodedName;
    }

}
/**
 * Convert the valid symbols to invalid symbols
 * @param string $name
 * 
 * @return string
 */
if(!function_exists('path_decode'))
{
    function path_decode(string $name): string
    {

        $decodeArray = [
            (object)[
                "decode" => '\\',
                "encode" => '%1',
            ],
            (object)[
                "decode" => '/',
                "encode" => '%2',
            ],
            (object)[
                "decode" => ':',
                "encode" => '%3',
            ],
            (object)[
                "decode" => '*',
                "encode" => '%4',
            ],
            (object)[
                "decode" => '?',
                "encode" => '%5',
            ],
            (object)[
                "decode" => '"',
                "encode" => '%6',
            ],
            (object)[
                "decode" => '<',
                "encode" => '%7',
            ],
            (object)[
                "decode" => '>',
                "encode" => '%8',
            ],
            (object)[
                "decode" => '|',
                "encode" => '%9',
            ],
        ];

        $decodedName = $name;
        foreach ($decodeArray as $array) {
            $decodedName = str_replace($array->encode, $array->decode, $decodedName);
        };
    
        return $decodedName;
    }

}