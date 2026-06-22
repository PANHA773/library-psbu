<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ApiKeyHelper
{
    public static function generate()
    {
        return Str::random(40);
    }
}
