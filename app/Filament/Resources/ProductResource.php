<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CreationTimeColumn;
use App\Filament\Custom\ModificationTimeColumn;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'phosphor-desk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('product.sections.information'))->schema([
                    Grid::make(2)->schema([

                        TextInput::make('name')
                            ->suffixIcon('phosphor-tag')
                            ->label(__('product.model.name')),

                        TextInput::make('price')
                            ->minValue(0)
                            ->suffixIcon('phosphor-currency-dollar')
                            ->numeric()
                            ->label(__('product.model.price')),

                        TextInput::make('stock')
                            ->minValue(0)
                            ->suffixIcon('phosphor-stack')
                            ->numeric()
                            ->label(__('product.model.stock')),

                        Textarea::make('description')
                            ->columnSpanFull()
                            ->label(__('product.model.description')),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                    ->searchable()
            ->columns([
                TextColumn::make('name')
                    ->label(__('product.model.name'))
                    ->sortable(),
TextColumn::make('description')
                    ->label(__('product.model.description')),

TextColumn::make('price')
                    ->label(__('product.model.price'))
                    ->sortable(),
TextColumn::make('stock')
                    ->label(__('product.model.stock'))
                    ->sortable(),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
