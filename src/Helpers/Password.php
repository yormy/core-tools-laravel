<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Password
{
    public static function Encrypt(String $password) : string
    {
        return bcrypt(Hasher::hash($password));
    }
}