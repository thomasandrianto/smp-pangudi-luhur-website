<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMessages extends BaseWidget
{
    protected static ?string $heading = 'Pesan Terbaru';

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Message::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),

                Tables\Columns\TextColumn::make('message')
                    ->limit(30),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-exclamation-circle')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y'),
            ]);
    }
}