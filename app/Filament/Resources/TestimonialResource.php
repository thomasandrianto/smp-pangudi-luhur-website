<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left';
    protected static ?string $navigationGroup = 'Interaksi';
    protected static ?int $navigationSort = 41;

    protected static ?string $modelLabel = 'Testimoni';
    protected static ?string $pluralModelLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama')
                ->required(),

            TextInput::make('email')
                ->label('Email'),

            Textarea::make('content')
                ->label('Isi Testimoni')
                ->required(),

            Toggle::make('is_published')
                ->label('Publish'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Testimoni')
                    ->slideOver(),
            ])
            ->columns([
                TextColumn::make('nomor')
                    ->rowIndex(),

                TextColumn::make('name')
                    ->label('Nama'),

                TextColumn::make('content')
                    ->limit(50),

                TextColumn::make('is_published')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Publish' : 'Draft'),

                TextColumn::make('created_at')
                    ->dateTime('d-m-Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton()
                    ->slideOver(),

                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->emptyStateHeading('Belum ada testimoni')
            ->emptyStateDescription('Tambahkan testimoni pertama.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
        ];
    }
}