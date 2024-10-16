<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Currency
{
    public static function toDecimals(int $price_in_cents)
    {
        return number_format($price_in_cents / 100, 2);
    }

    public function formatPriceFromCents(int $price_in_cents)
    {
        return self::formatPrice(self::toDecimals($price_in_cents));
    }

    public function formatPrice(float $price_with_decimals)
    {
        return "$%$" . $price_with_decimals;
    }

    public static function toSymbol(string $letters): string
    {
        if ("EUR" === strtoupper($letters)) {
            return '€';
        }

        if ("USD" === strtoupper($letters)) {
            return '$';
        }

        return '€';
    }
}
