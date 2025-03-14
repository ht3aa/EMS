<?php

namespace App\Filament\Widgets;

use App\Enums\MonthsEnum;
use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class OrdersChart extends ChartWidget
{
    protected int|string|array $columnSpan = 'full';

    public function getHeading(): string|Htmlable|null
    {
        return __('order.charts.orders_per_month');
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $this->getOrdersPerMonth(),
                    'fill' => 'start',
                ],
            ],
            'labels' => MonthsEnum::labels(),
        ];
    }

    private function getOrdersPerMonth()
    {
        return Order::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->mapWithKeys(fn ($order) => [MonthsEnum::tryFrom(
                (int) $order->month
            )->getLabel() => $order->count])
            ->toArray();
    }

    protected function getType(): string
    {
        return 'line';
    }
}
