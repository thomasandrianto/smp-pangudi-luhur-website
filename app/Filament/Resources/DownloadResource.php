<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Models\Download;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationGroup = 'Media';
    protected static ?int $navigationSort = 32;

    protected static ?string $modelLabel = 'Download';
    protected static ?string $pluralModelLabel = 'Download';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),

            Textarea::make('description'),

            FileUpload::make('file_path')
                ->directory('downloads')
                ->required(),

            TextInput::make('file_size')
                ->label('Ukuran File (opsional)'),
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

                TextColumn::make('title')->searchable(),

                TextColumn::make('file_size'),

                TextColumn::make('download_count')
                    ->label('Download'),

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
            'index' => Pages\ListDownloads::route('/'),
        ];
    }
}