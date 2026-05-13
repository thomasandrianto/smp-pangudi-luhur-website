<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Models\Announcement;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Pengumuman';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->maxLength(255),

            RichEditor::make('content')
                ->label('Isi Pengumuman')
                ->required(),

            DateTimePicker::make('published_at')
                ->label('Tanggal Publish')
                ->seconds(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('published_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Pengumuman')
                    ->slideOver()
                    ->modalWidth('4xl'),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('published_at')
                    ->label('Publish')
                    ->dateTime('d-m-Y H:i'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver()
                    ->modalWidth('4xl'),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateHeading('Belum ada pengumuman')
            ->emptyStateDescription('Silakan tambahkan pengumuman pertama.')
            ->emptyStateIcon('heroicon-o-megaphone');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnouncements::route('/'),
        ];
    }
}