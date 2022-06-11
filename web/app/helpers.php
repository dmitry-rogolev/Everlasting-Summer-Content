<?php

use Illuminate\Support\Str;

if (!function_exists("id"))
{
    function id(?string $prefix = null, ?int $length = null) : string
    {
        return ($prefix ?? config("view.id_prefix")) . Str::random($length ?? config("view.id_length"));
    }
}