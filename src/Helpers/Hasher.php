<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Hasher
{
    public static function hash(string $value, string $salt = ''): string
    {
        return hash('sha512', $salt.$value);
    }
}
