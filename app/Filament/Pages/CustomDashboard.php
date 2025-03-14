<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OrdersChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard;

class CustomDashboard extends Dashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            OrdersChart::class,
        ];
    }
}
