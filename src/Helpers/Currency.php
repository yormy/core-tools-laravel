<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Currency
{
    public static function toDecimals(int $price_in_cents): string
    {
        return number_format($price_in_cents / 100, 2);
    }

    public function formatPriceFromCents(int $price_in_cents): string
    {
        return self::formatPrice(self::toDecimals($price_in_cents));
    }

    public function formatPrice(float $price_with_decimals): string
    {
        return '$%$'.$price_with_decimals;
    }

    public static function toSymbol(string $letters): string
    {
        if (strtoupper($letters) === 'EUR') {
            return '€';
        }

        if (strtoupper($letters) === 'USD') {
            return '$';
        }

        return '€';
    }
}
