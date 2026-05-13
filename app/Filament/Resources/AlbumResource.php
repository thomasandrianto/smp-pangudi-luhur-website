<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Models\Album;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Media';
    protected static ?int $navigationSort = 30;

    protected static ?string $modelLabel = 'Album';
    protected static ?string $pluralModelLabel = 'Album';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Album')
                ->required(),

            FileUpload::make('cover')
                ->label('Cover')
                ->image()
                ->directory('albums')
                ->imagePreviewHeight('150'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Album')
                    ->slideOver()
                    ->mutateFormDataUsing(fn ($data) => [
                        ...$data,
                        'created_by' => auth()->id(),
                    ]),
            ])
            ->columns([
                TextColumn::make('nomor')->rowIndex(),

                ImageColumn::make('cover')
                    ->label('Cover'),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('galleries_count')
                    ->counts('galleries')
                    ->label('Jumlah Foto'),

                TextColumn::make('created_at')
                    ->dateTime('d-m-Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton()->slideOver(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
        ];
    }
}