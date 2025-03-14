<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('user.stats.total'), User::count())
                ->chart([2, 2])
                ->color('primary'),
            Stat::make(__('product.stats.total'), Product::count())
                ->chart([2, 2])
                ->color('primary'),
            Stat::make(__('order.stats.total'), Order::count())
                ->chart([2, 2])
                ->color('primary'),
        ];
    }
}
