<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Enums\OrderStatusEnum;
use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            __('order.tabs.all') => Tab::make(),
            __('order.tabs.created') => Tab::make()
->icon('phosphor-package')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatusEnum::CREATED)),
            __('order.tabs.shipped') => Tab::make()
->icon('phosphor-truck')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatusEnum::SHIPPED)),
            __('order.tabs.delivered') => Tab::make()
->icon('phosphor-check')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', OrderStatusEnum::DELIVERED)),
        ];
    }
}
