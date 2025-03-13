<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CreationTimeColumn;
use App\Filament\Custom\ModificationTimeColumn;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'phosphor-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('user.sections.information'))->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label(__('user.model.name'))
                            ->suffixIcon('heroicon-o-user')
                            ->required()
                            ->placeholder('John Doe'),

                        TextInput::make('email')
                            ->email()
                            ->suffixIcon('phosphor-mailbox')
                            ->required()
                            ->label(__('user.model.email')),

                        TextInput::make('password')
                            ->password()
                            ->suffixIcon('phosphor-key')
                            ->required()
                            ->label(__('user.model.password')),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable()
            ->striped()
            ->columns([
                TextColumn::make('name')
                    ->label(__('user.model.name'))
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('user.model.email'))
                    ->toggleable()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
