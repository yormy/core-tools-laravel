<?php

namespace Yormy\CoreToolsLaravel\Helpers;

use HTMLPurifier;
use HTMLPurifier_Config;

class Purifier
{
    public static function stripHtml(string $dirtyHtml)
    {
        return htmlspecialchars($dirtyHtml);
    }

    public static function cleanHtml(string $dirtyHtml, string $allowedHtml = null): string
    {
        $storagePath = config('htmlpurifier.cache_directory');
        $cacheDirectory = storage_app_path($storagePath);
        self::makeCache($cacheDirectory);

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'utf-8');
        $config->set('Cache.SerializerPath', storage_app_path($storagePath));
        $config->set('HTML.Doctype', 'XHTML 1.0 Transitional');
        if (!$allowedHtml) {
            $config->set('HTML.Allowed', 'b,i,u,p,em,strong,cite,blockquote,code,ul,ol,li,dl,dt,dd,p,br,h1,h2,h3,h4,h5,h6');
        } else {
            $config->set('HTML.Allowed', $allowedHtml);
        }

        $config->set('HTML.AllowedAttributes', 'src,*.href,title,target,alt,style');

        $config->set('AutoFormat.AutoParagraph', false);
        $config->set('AutoFormat.RemoveEmpty', true);

        $purifier = new HTMLPurifier($config);

        return $purifier->purify($dirtyHtml);
    }

    private static function makeCache(string $cacheDirectory)
    {
        if (!file_exists($cacheDirectory)) {
            mkdir($cacheDirectory, 0666, true);
        }
    }
}
