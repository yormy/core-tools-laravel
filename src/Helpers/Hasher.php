<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Hasher
{
    public static function hash(String $value) : string
    {
        return hash('sha512', $value);
    }

}