<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
    protected static ?string $heading = 'Post Terbaru';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Post::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(40),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y'),
            ]);
    }
}