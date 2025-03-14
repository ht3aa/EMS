<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MonthsEnum: int implements HasLabel
{
    case JANUARY = 1;
    case FEBRUARY = 2;
    case MARCH = 3;
    case APRIL = 4;
    case MAY = 5;
    case JUNE = 6;
    case JULY = 7;
    case AUGUST = 8;
    case SEPTEMBER = 9;
    case OCTOBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    public function getLabel(): string
    {
        return match ($this) {
            self::JANUARY => __('system.months.january'),
            self::FEBRUARY => __('system.months.february'),
            self::MARCH => __('system.months.march'),
            self::APRIL => __('system.months.april'),
            self::MAY => __('system.months.may'),
            self::JUNE => __('system.months.june'),
            self::JULY => __('system.months.july'),
            self::AUGUST => __('system.months.august'),
            self::SEPTEMBER => __('system.months.september'),
            self::OCTOBER => __('system.months.october'),
            self::NOVEMBER => __('system.months.november'),
            self::DECEMBER => __('system.months.december'),

        };
    }

    public static function labels()
    {
        return [
            __('system.months.january'),
            __('system.months.february'),
            __('system.months.march'),
            __('system.months.april'),
            __('system.months.may'),
            __('system.months.june'),
            __('system.months.july'),
            __('system.months.august'),
            __('system.months.september'),
            __('system.months.october'),
            __('system.months.november'),
            __('system.months.december'),
        ];
    }
}
