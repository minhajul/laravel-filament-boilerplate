<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Forms\Components;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions;
use Filament\Tables\Columns;
use Filament\Tables\Table;

final class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('name')
                    ->required(),

                Components\TextInput::make('email')
                    ->email()
                    ->required(),

                Components\Checkbox::make('is_admin')
                    ->required(),

                Section::make('Password')
                    ->schema([
                        Components\TextInput::make('password')
                            ->password()
                            ->maxLength(255)
                            ->dehydrated(fn ($state) => filled($state))
                            ->nullable()
                            ->required(fn ($livewire) => $livewire instanceof CreateRecord),

                        Components\TextInput::make('password_confirmation')
                            ->password()
                            ->maxLength(255)
                            ->label('Confirm Password')
                            ->same('password')
                            ->nullable()
                            ->required(fn ($livewire) => $livewire instanceof CreateRecord),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('name')
                    ->searchable(),

                Columns\TextColumn::make('email')
                    ->searchable(),

                Columns\TextColumn::make('is_admin')
                    ->label('User Type')
                    ->formatStateUsing(fn ($state) => $state ? 'Admin' : 'User')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray'),

                Columns\TextColumn::make('email_verified_at')
                    ->label('Verified At')
                    ->getStateUsing(fn ($record) => $record->email_verified_at ? 'Verified' : 'Not Verified')
                    ->badge()
                    ->color(fn ($state) => $state === 'Verified' ? 'success' : 'warning'),

                Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
                Actions\RestoreAction::make(),
            ])
            ->groupedBulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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

    public static function getWidgets(): array
    {
        return [

        ];
    }
}
