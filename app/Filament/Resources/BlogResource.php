<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components;
use Filament\Actions;
use Filament\Tables\Columns;
use Filament\Tables\Table;

final class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),

                Components\Select::make('status')
                    ->options(BlogStatus::options())
                    ->required()
                    ->columnSpanFull(),

                Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->columnSpanFull(),

                Components\FileUpload::make('banner_path')
                    ->columnSpanFull(),

                Components\MarkdownEditor::make('details')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('title')
                    ->searchable(),

                Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),

                Columns\TextColumn::make('user.name'),

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
                Actions\DeleteBulkAction::make(),
                Actions\RestoreBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit'   => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
