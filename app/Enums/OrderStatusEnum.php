<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: int implements HasColor, HasIcon, HasLabel
{
    case CREATED = 0;

    case SHIPPED = 1;

    case DELIVERED = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::CREATED => __('order.columns.status.created'),
            self::SHIPPED => __('order.columns.status.shipped'),
            self::DELIVERED => __('order.columns.status.delivered'),
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CREATED => 'phosphor-package',
            self::SHIPPED => 'phosphor-truck',
            self::DELIVERED => 'phosphor-check',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CREATED => 'info',
            self::SHIPPED => 'warning',
            self::DELIVERED => 'success',
        };
    }
}
