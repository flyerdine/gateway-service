<?php

namespace App\Helpers;

class RequestHelper
{
    // simple helper function to filter header array on request & response
    public static function filterHeaders($headers)
    {
        $allowedHeaders = ['accept', 'content-type', 'authorization'];
        return array_filter($headers, function ($key) use ($allowedHeaders) {
            return in_array(strtolower($key), $allowedHeaders);
        }, ARRAY_FILTER_USE_KEY);
    }
}
