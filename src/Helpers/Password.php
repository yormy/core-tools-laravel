<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Password
{
    public static function hashEncrypt(String $password) : string
    {
        return self::encrypt(self::hash($password));
    }

    public static function encrypt(String $password) : string
    {
        return bcrypt($password);
    }

    public static function hash(String $password) : string
    {
        return Hasher::hash($password);
    }
}