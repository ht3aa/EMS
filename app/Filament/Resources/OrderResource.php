<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CreationTimeColumn;
use App\Filament\Custom\ModificationTimeColumn;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-package';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable()
            ->modifyQueryUsing(fn ($query) => $query->with(['cart', 'cart.user', 'cart.product']))
            ->columns([
                TextColumn::make('cart.user.name')
                    ->toggleable()
                    ->label(__('order.columns.user.name')),

                TextColumn::make('cart.product.name')
                    ->toggleable()
                    ->label(__('order.columns.product.name')),

                TextColumn::make('cart.product.price')
                    ->toggleable()
                    ->label(__('order.columns.product.price')),

                TextColumn::make('cart.quantity')
                    ->toggleable()
                    ->label(__('order.columns.quantity')),

                TextColumn::make('status')
                    ->toggleable()
                    ->badge()
                    ->label(__('order.columns.status.title')),

                CreationTimeColumn::make('created_at'),
                ModificationTimeColumn::make('updated_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
