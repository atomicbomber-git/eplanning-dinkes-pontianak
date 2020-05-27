<?php


namespace App\Support;

use Jenssegers\Date\Date;

class Formatter
{
    public static function fancyDatetime($datetime)
    {
        return (new Date($datetime))->format("l, d F Y H:i:s");
    }
}
