<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Password
{
    public static function hashEncrypt(string $password): string
    {
        return self::encrypt(self::hash($password));
    }

    public static function encrypt(string $password): string
    {
        return bcrypt($password);
    }

    public static function hash(string $password): string
    {
        return Hasher::hash($password);
    }
}
