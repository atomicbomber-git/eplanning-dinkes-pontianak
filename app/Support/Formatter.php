<?php


namespace App\Support;

use Jenssegers\Date\Date;

class Formatter
{
    public static function fancyDatetime($datetime)
    {
        return (new Date($datetime))->format("l, d F Y H:i:s");
    }

    public static function currency($amount): string
    {
        if (empty($amount)) {
            return "-";
        }

        return number_format($amount);
    }

    public static function normalizeNumber($number)
    {
        return rtrim(rtrim($number, "0"), ".");
    }
}
