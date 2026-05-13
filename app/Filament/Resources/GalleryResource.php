<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Media';
    protected static ?int $navigationSort = 31;

    protected static ?string $modelLabel = 'Galeri';
    protected static ?string $pluralModelLabel = 'Galeri';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('album_id')
                ->relationship('album', 'name')
                ->required(),

            TextInput::make('title')
                ->label('Judul'),

            FileUpload::make('image')
                ->image()
                ->directory('galleries')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver()
                    ->mutateFormDataUsing(fn ($data) => [
                        ...$data,
                        'uploaded_by' => auth()->id(),
                    ]),
            ])
            ->columns([
                TextColumn::make('nomor')->rowIndex(),

                ImageColumn::make('image')
                    ->label('Foto'),

                TextColumn::make('album.name')
                    ->label('Album'),

                TextColumn::make('title'),

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
            'index' => Pages\ListGalleries::route('/'),
        ];
    }
}