<?php
declare(strict_types=1);
namespace Projom\Util;

use Projom\Util\File\Write as FileWriter;

class Curl
{
    const TIME_OUT_SECONDS = 3;

    public static function get(string $url) {

        $handle = curl_init();
        curl_setopt($handle, \CURLOPT_HTTPGET, true);        
        curl_setopt($handle, \CURLOPT_URL, $url);        
        curl_setopt($handle, \CURLOPT_HEADER, false);
        curl_setopt($handle, \CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, \CURLOPT_TIMEOUT, static::TIME_OUT_SECONDS);                             

        $result = curl_exec($handle);
        curl_close($handle);
        return $result;
    }

    public static function getPut(string $url,
                                  string $filename)
    {
        if (!$response = static::get($url))
            return false;
        
        if (!$result = FileWriter::toFilepath($filename, $response))
            return false;
        
        return true;
    }
}
