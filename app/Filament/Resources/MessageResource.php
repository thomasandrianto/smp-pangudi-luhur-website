<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Interaksi';
    protected static ?int $navigationSort = 40;

    protected static ?string $modelLabel = 'Pesan';
    protected static ?string $pluralModelLabel = 'Pesan Masuk';

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nomor')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('name')
                    ->label('Nama'),

                TextColumn::make('email')
                    ->label('Email'),

                TextColumn::make('phone')
                    ->label('HP'),

                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(40),

                IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->actions([
                Tables\Actions\Action::make('read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check')
                    ->action(fn ($record) => $record->update(['is_read' => true]))
                    ->visible(fn ($record) => !$record->is_read),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->emptyStateHeading('Belum ada pesan')
            ->emptyStateDescription('Pesan dari pengunjung akan tampil di sini.')
            ->emptyStateIcon('heroicon-o-envelope');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
        ];
    }
}